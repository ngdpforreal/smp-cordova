<?php

namespace App\Helpers;

class TiptapParser
{
    public static function toHtml($content)
    {
        // Simpan konten asli untuk cadangan jika bukan JSON
        $originalContent = $content;

        // 1. Coba decode jika inputnya string
        if (is_string($content)) {
            $decoded = json_decode($content, true);
            
            // Jika decoding berhasil dan hasilnya array valid, gunakan hasil decode
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $content = $decoded;
            } else {
                // Jika gagal decode (berarti ini HTML/Teks biasa), kembalikan aslinya
                return $originalContent;
            }
        }

        // 2. Validasi Struktur Tiptap
        // Pastikan ini benar-benar format Tiptap (punya key 'type' => 'doc')
        if (!is_array($content) || !isset($content['type']) || $content['type'] !== 'doc') {
            return $originalContent;
        }

        // 3. Render Tiptap ke HTML
        $html = '';
        if (isset($content['content'])) {
            foreach ($content['content'] as $node) {
                $html .= self::renderNode($node);
            }
        }
        return $html;
    }

    private static function renderNode($node)
    {
        $type = $node['type'];
        $content = '';

        // Render anak-anak node (recursive)
        if (isset($node['content'])) {
            foreach ($node['content'] as $child) {
                $content .= self::renderNode($child);
            }
        } elseif (isset($node['text'])) {
            // Render Text & Marks (Bold, Italic, Link)
            $text = htmlspecialchars($node['text']);
            if (isset($node['marks'])) {
                foreach ($node['marks'] as $mark) {
                    switch ($mark['type']) {
                        case 'bold': $text = "<strong>$text</strong>"; break;
                        case 'italic': $text = "<em>$text</em>"; break;
                        case 'underline': $text = "<u>$text</u>"; break;
                        case 'link': 
                            $href = $mark['attrs']['href'] ?? '#';
                            $text = "<a href='$href' target='_blank' class='text-yayasan hover:underline'>$text</a>"; 
                            break;
                    }
                }
            }
            return $text;
        }

        // Render Block Types
        switch ($type) {
            case 'paragraph': 
                $class = isset($node['attrs']['textAlign']) ? 'text-'.$node['attrs']['textAlign'] : '';
                return "<p class='mb-4 $class'>$content</p>";
            case 'heading': 
                $level = $node['attrs']['level'] ?? 2;
                return "<h$level class='font-bold text-gray-900 mt-6 mb-3 text-xl'>$content</h$level>";
            case 'bulletList': return "<ul class='list-disc pl-5 mb-4'>$content</ul>";
            case 'orderedList': return "<ol class='list-decimal pl-5 mb-4'>$content</ol>";
            case 'listItem': return "<li>$content</li>";
            case 'blockquote': return "<blockquote class='border-l-4 border-gold pl-4 italic my-4'>$content</blockquote>";
            case 'horizontalRule': return "<hr class='my-6'>";
            case 'image':
                $src = $node['attrs']['src'] ?? '';
                $alt = $node['attrs']['alt'] ?? '';
                return "<img src='$src' alt='$alt' class='rounded-lg my-4 w-full h-auto'>";
            default: return $content;
        }
    }
    
    public static function toText($content)
    {
        return strip_tags(self::toHtml($content));
    }
}