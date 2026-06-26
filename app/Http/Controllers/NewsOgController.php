<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsOgController extends Controller
{
    public function show(string $slug)
    {
        $article = null;
        $apiBase = 'https://admin.leadsagri.com/api/news';

        // Extract numeric id from end of slug (e.g. "my-article-title-42")
        $targetId = null;
        if (preg_match('/^(.+)-(\d+)$/', $slug, $m)) {
            $targetId = $m[2];
        } elseif (ctype_digit($slug)) {
            $targetId = $slug;
        }

        // Fetch the full list and find the article by id
        try {
            $response = Http::timeout(10)->get($apiBase);
            if ($response->successful()) {
                $list = $response->json();
                if (is_array($list)) {
                    foreach ($list as $item) {
                        if ($targetId && isset($item['id']) && (string) $item['id'] === (string) $targetId) {
                            $article = $item;
                            break;
                        }
                        // fallback: match by slug field if available
                        if (!$targetId && isset($item['slug']) && $item['slug'] === $slug) {
                            $article = $item;
                            break;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // fall through to defaults
        }

        // Build OG data from article or use site defaults
        $siteUrl = 'https://leadsagri.com';
        $pageUrl  = $siteUrl . '/news/' . $slug;

        if ($article) {
            $ogTitle       = $article['title'] ?? 'Leads Agri';
            $rawDescription = $article['content'] ?? $article['description'] ?? $article['excerpt'] ?? $article['body'] ?? 'Latest news from Leads Agri.';
            // Strip HTML tags and truncate description to ~200 chars
            $ogDescription = strip_tags($rawDescription);
            if (mb_strlen($ogDescription) > 200) {
                $ogDescription = mb_substr($ogDescription, 0, 197) . '...';
            }
            // featured_image_url is the correct field from the API
            $ogImage = $article['featured_image_url'] ?? $article['image'] ?? $article['thumbnail'] ?? $article['photo'] ?? null;
            // If featured_image_url is an array (featured_image_2_url style), take the first element
            if (is_array($ogImage)) {
                $ogImage = $ogImage[0] ?? null;
            }
            if (!$ogImage) {
                $ogImage = $siteUrl . '/images/logo-green.png';
            }
            // Ensure absolute URL for image
            if ($ogImage && !str_starts_with($ogImage, 'http')) {
                $ogImage = $siteUrl . '/' . ltrim($ogImage, '/');
            }
        } else {
            $ogTitle       = 'Leads Agri';
            $ogDescription = 'Latest news and updates from Leads Agri.';
            $ogImage       = $siteUrl . '/images/logo-green.png';
        }

        return view('welcome', compact('ogTitle', 'ogDescription', 'ogImage', 'pageUrl'));
    }
}
