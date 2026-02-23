<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsOgController extends Controller
{
    public function show(string $slug)
    {
        $article = null;
        $apiBase = 'https://admin.leadsagri.site/api/news';

        // Try to extract numeric id from end of slug (e.g. "my-article-title-42")
        if (preg_match('/^(.+)-(\d+)$/', $slug, $m)) {
            $id = $m[2];
            try {
                $response = Http::timeout(5)->get("{$apiBase}/{$id}");
                if ($response->successful()) {
                    $article = $response->json();
                }
            } catch (\Exception $e) {
                // fall through
            }
        }

        // If not found yet and slug is purely numeric, fetch by id directly
        if (!$article && ctype_digit($slug)) {
            try {
                $response = Http::timeout(5)->get("{$apiBase}/{$slug}");
                if ($response->successful()) {
                    $article = $response->json();
                }
            } catch (\Exception $e) {
                // fall through
            }
        }

        // Fallback: search the list by slug or id
        if (!$article) {
            try {
                $response = Http::timeout(5)->get($apiBase);
                if ($response->successful()) {
                    $list = $response->json();
                    if (is_array($list)) {
                        $rawSlug = preg_replace('/-\d+$/', '', $slug);
                        foreach ($list as $item) {
                            if (
                                (isset($item['slug']) && $item['slug'] === $rawSlug) ||
                                (isset($item['slug']) && $item['slug'] === $slug) ||
                                (isset($item['id']) && (string) $item['id'] === $slug)
                            ) {
                                $article = $item;
                                break;
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                // fall through
            }
        }

        // Build OG data from article or use site defaults
        $siteUrl = 'https://leadsagri.com';
        $pageUrl  = $siteUrl . '/news/' . $slug;

        if ($article) {
            $ogTitle       = $article['title']       ?? 'Leads Agri';
            $ogDescription = $article['description'] ?? $article['excerpt'] ?? $article['body'] ?? 'Latest news from Leads Agri.';
            // Truncate description to ~200 chars
            if (mb_strlen($ogDescription) > 200) {
                $ogDescription = mb_substr($ogDescription, 0, 197) . '...';
            }
            $ogImage = $article['image'] ?? $article['thumbnail'] ?? $article['photo'] ?? $siteUrl . '/images/logo-green.png';
            // Ensure absolute URL for image
            if ($ogImage && !str_starts_with($ogImage, 'http')) {
                $ogImage = $siteUrl . '/' . ltrim($ogImage, '/');
            }
        } else {
            $ogTitle       = 'Leads Agri';
            $ogDescription = 'Latest news and updates from Leads Agri.';
            $ogImage       = $siteUrl . '/images/logo-green.png';
        }

        return view('news-og', compact('ogTitle', 'ogDescription', 'ogImage', 'pageUrl'));
    }
}
