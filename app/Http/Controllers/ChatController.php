<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    private $mistralApiKey;
    private $mistralApiUrl = 'https://api.mistral.ai/v1/chat/completions';
    // Reasonable upper bound for appended context to control prompt tokens
    private $maxContextChars = 2000;

    /**
     * Herbicide context for all chat requests.
     * @var string
     */
    private $Context = <<<CONTEXT
HERBICIDE
🌿 Weeds/Damo? Subukan ang *Frontier 200 OD* — post-emergent at nanunuot sa halaman.

✅ Rescue application = best protection
💧 Gamitin sa unang aplikasyon at bilang rescue application
🥶 Malamig ang pormulasyon sa palay – hindi nasusunog ang halaman

🌿 Weeds/Damo? Subukan ang *Frontier MAX!* — post-emergent herbicide na may halong Leads Exit.

✅ Rescue application = best protection
💧 Gamitin sa unang aplikasyon at bilang rescue application
🥶 Malamig ang pormulasyon sa palay – hindi nasusunog ang halaman

🌿 Weeds/Damo? Subukan ang *Mower 48 SL!* — foliar herbicide na nanunuot sa buong halaman at sa ugat nito para sa pag-kontrol ng damo.

✅ Foliar = puwedeng i-apply sa dahon ng damo
💧 Gamitin sa unang aplikasyon at bilang rescue application
🥬 Pwedeng gamitin sa iba't-ibang tanim na gulay

🌿 Weeds/Damo? Subukan ang *Mower Ultra 514 SL!* — post-emergent general weed killer na kumokontrol sa paglago at pagdami ng iba't-ibang damo sa taniman, lalo na sa maisan.

✅ Systemic action = mabilis manuot sa damo
💧 May kombinasyon ng mga kemikal na pumipigil sa shoot and root elongation o paglago ng damo
❌ Walang latak sa taniman

🌿 Weeds/Damo? Subukan ang *Agil 100 EC!* — post-emergent herbicide na pumupuksa sa damo sa tanim na sibuyas.

☔ May rainfast formula = hindi basta nawawala kahit umuulan
🧅 Mabisa sa tanim na sibuyas

🌿 Weeds/Damo? Subukan ang *Top Ace 80 SC!* — post-emergent general weed killer na kumokontrol sa paglago at pagdami ng iba't-ibang damo sa taniman, lalo na sa maisan.

✅ Systemic action = mabilis kumalat paloob sa mga ugat ng damo
⏳ May long residual action kaya nananatili ang bisa
👍 Puwede bilang pre-emergent, early post-emergent at late post-emergent

🌿 Weeds/Damo? Subukan ang *Top Ace MAX!* — may pinagsamang pwersa ng Top Ace at Leads Exit

✅ Mayroon tong Diuron = sangkap na nanunuot sa damo
⏳ Malawak ang timing ng aplikasyon
👍 Puwede bilang early hanggang post-emergent: pumupuksa sa damo sa iba't-ibang yugto ng paglaki nito

🌿 Weeds/Damo? Subukan ang *Ignite 15 SL!* — non-selective herbicide laban sa mga damong mahirap puksain at umaagaw sa nutrition ng mga tanim.

✅ Maaaring gamitin bilang pamatay-damo sa cavendish bananas, rubber, oil palm, at bilang industrial weed control
🏜️ Pwede sa sloping areas para maiwasan ang soil erosion

FUNGICIDE
🧪 Sakit sa taniman? Subukan ang *Fuji One 41.2 EC!* — isang systemic fungicide laban sa rice blast

✅ May positibong epekto sa kalusugan ng tanim
🤝 May epektong pang-iwas at panlunas laban sa mga sakit na dumadapo sa tanim na palay
💰 Matipid at sulit gamitin = hindi kailangan ihalo sa ibang fungicides

🧪 Sakit sa tanim na mangga? Subukan ang *STK Regev!* — ang kauna-unahang hybrid fungicide sa bansa!

🪴 May pinagsamang lakas ng tea tree oil at systemic fungicde
🥭 Tina-target ang mga sakit na pumupuntirya sa tanim na mangga


🧪 Sakit sa tanim na mangga? Subukan ang *Domark Pro!* — isang systemic fungicide laban sa sakit sa manggahan!

🥭 Maaaring magpataas ng ani hanggang 30% kung gagamitin kasama ang nirekomendang pataba ng halaman
🪴 Tinutulungan ang pagsipsip at paggamit ng halaman sa sustansya mula sa lupa
🔒 Natutulungang mabawasan ang aksaya sa abono


🧪 Sakit sa palayan? Subukan ang *BM 20 WG!* — isang broad-spectrum fungicide/bactericide!

🧫 Mahusay itong pamatay sa bacterial leaf blight, bacterial leaf streak, at iba pang sakit
🦠 Pumupuntirya rin ito ng amag sa palayan


🧪 Sakit sa manggahan? Subukan ang *Timorex Gold!* — organic fungicide laban sa mga sakit!

🧫 Mahusay itong pamatay sa blossom blight, anthracnose scab, at stem-end rot sa manggahan
🦠 Bilang broad spectrum biofungicide, ito ay gumagamit ng tea tree oil


🧪 Sakit sa manggahan? Subukan ang *Manager 80 WP!* — contact fungicide para sa iyong gulayan!

🧫 Nagtataglay ng Mancozeb: broad spectrum fungicide laban sa fungal diseases
🦠 Naglalaman ng zinc at manganese para sa dagdag-proteksyon sa halaman
💧 Madaling haluin sa tubig


🧪 Sakit sa manggahan? Subukan ang *Armor 70 WP!* — isang systemic fungicide laban sa mga sakit sa gulayan!

🧫 Broad-spectrum fungicide = panlaban sa iba't-ibang sakit
⏳ Systemic at nanunuot sa halaman para sa mas matagal na bisa

🧪 Sakit sa manggahan? Subukan ang *Leadonil 500 EC!* — isang broad-spectrum agricultural fungicide panlaban sa iba't-ibang sakit!

🧫 May 50% Chlorothalonil: may dagdag protection laban sa sakit
⏳ Tumatagal ang bisa sa mga tanim laban sa mildew, purple blotch, rust, etc.

🧪 Sakit sa manggahan? Subukan ang *Leadonil 500 EC!* — isang broad-spectrum agricultural fungicide panlaban sa iba't-ibang sakit!

🧫 May 50% Chlorothalonil: may dagdag protection laban sa sakit
⏳ Tumatagal ang bisa sa mga tanim laban sa mildew, purple blotch, rust, etc.

BIOSTIMULANT
🌸 Gustong palaguin ang taniman? Subukan ang *iSmart Nano Urea!* — isang makabagong fertilizer!

🦠 May lunas ng nano-technology: mayroon itong maliliit na nitrogen particles na mas madaling sinisipsip ng tanim
🌾 Sariwa at malusog ang ugat -- matibay sa tag-init o tag-ulan
🌱 Malakas at buo ang tubo mulat ugat hanggang dahon

🌸 Gustong palaguin ang taniman? Subukan ang *iSmart Boom Flower-n!* — isang makabagong fertilizer!

🦠 May lunas ng Nitrobenzene na natural na vegetable protein
🌼 Plant energizer, flowering stimulant, at yield booster
🌱 Pinapalakas ang postura ng halaman

🌸 Gustong palaguin ang taniman? Subukan ang *iSmart Ceres!* — isang biostimulant na nagpapabulas ng tanim!

🦠 Tumutulong upang labanan ang abiotic stress at transplanting shock na dulot ng init, tagtuyot, at baha
🌱 Pinapaganda ang pagsibol ng buto
💪 Pinapahaba ang ugat para makasipsip ng mas maraming sustansya

🌸 Gustong palaguin ang taniman? Subukan ang *Tecamin Max!* — isang foliar biostimulant na nagpapataas ng kalidad ng tanim!

💊 May amino acids na nakakatulong sa development ng bunga
💉 May nitrogen pampabulas ng bunga
💪 Pinoprotektahan ang halaman laban sa abiotic stress kagaya ng tagtuyot

🌸 Gustong palaguin ang taniman? Subukan ang *Kawa 422!* — isang fortified organic fertilizer!

💊 May mga sustansyang nagpapaganda ng kondisyon ng lupang tinataniman
💦 Binibigyan ang lupa ng kapasidad na mag-imbak ng tubig
🪴 Magandang alternatibo sa chicken manure
🍃 Eco-friendly at organic

🌸 Gustong palaguin ang taniman? Subukan ang *Mega Booster!* — isang foliar fertilizer!

💊 May Potassium na nagbibigay nutrisyon sa tanim
💦 100% water-soluble: madaling haluin sa tubig
🌱 Pinapalakas ang panicle ng tanim laban sa fruit drop


INSECTICIDE
🐛 Gustong mabawasan ang pesteng insekto sa taniman? Subukan ang *Benefit 20 SC!* — isang systemic insecticide laban sa rice bug at rice black bug!

⏰ Nagbibigay ng matagal na proteksyon sa halaman
🦠 Nanunuot sa halaman -- long-lasting ang epekto
🦗 Malawak ang kontrol sa iba't-ibang klase ng peste
🌧️ Hindi madaling nahuhugasan ng ulan (tatlong oras pagkatapos i-spray)

🐛 Gustong mabawasan ang pesteng insekto sa taniman? Subukan ang *Starkle 20 SG!* — isang systemic insecticide laban sa insect pests!

🌿 May magandang foliar activity
☠️ May 3-way killing action: stomach, contact, at systemic
🦗 Tina-target ang brown planthoppers, green planthoppers, at rice bug
🌧️ Hindi madaling nahuhugasan ng ulan

🐛 Gustong mabawasan ang pesteng insekto sa taniman? Subukan ang *Lancer Gold 55 WG!* — isang insecticide laban sa insect pests!

🌿 Mabilis na nanunuot sa dahon
⏰ Mahaba ang application interval at hindi paulit-ulit ang pag-spray
🍃 May mahusay na translaminar effect
🦗 Tina-target ang brown planthoppers, green planthoppers, at rice bug
💦 Sakto ang timpalda at madaling nalulusaw pagkahalo sa tubig

🐛 Gustong mabawasan ang pesteng insekto sa taniman? Subukan ang *Brofreya 20SC* — isang insecticide laban sa insect pests!

🧬 May Tenebenal na mabisang pamatay-insekto
⏰ Mabilis na pinipigilan ang pagkain ng uod sa tanim hanggang tuluyan itong mapuksa; nananatili ang bisa sa halamang hanggang 15 araw
🍃 Agad na nanunuot sa dahon
💦 May rainfast formula kaya kumakapit ito sa halaman kahit ulanin

🐛 Gustong mabawasan ang pesteng insekto sa taniman? Subukan ang *Pleo 10 EC* — isang contact insecticide laban sa insect pests!

🧬 May Pyridalyl na mabisang pamatay-insekto: gumagamit ng kakaibang mode of action na mabisa laban sa iba't-ibang lebel at uri ng uod
🦗 Panlaban sa diamondback moth (DBM), cabbage worm, at cutworm
💦 May rainfast formula kaya kumakapit ito sa halaman kahit ulanin

🐛 Gustong mabawasan ang pesteng insekto sa taniman? Subukan ang *Rimon 10 EC* — isang contact insecticide laban sa insect pests!

🦗 Isang insect growth regulator na pumipigil sa paglaki ng uod
💪 Maaaring gamitin bilang alternatibong pamatay-uod para sa resistance management

🐛 Gustong mabawasan ang pesteng insekto sa taniman? Subukan ang *Aztron WDG* — isang contact insecticide laban sa insect pests!

🪱 May laman na Bacillus thuringiensis na lumulusaw sa protina sa loob ng sikmura ng uod
🌱 Isang biological insecticide kaya ligtas sa halaman at kalikasan


MOLLUSCICIDE
🐛 Gustong mabawasan ang pesteng kuhol? Subukan ang *Benefit 20 SC!* — isang systemic insecticide laban sa rice bug at rice black bug!

🐌 Mabilis kumontrol sa pesteng kuhol
💦 Madaling kumalat sa tubig pagkatapos i-spray
💰 Matipid at madaling gamitin dahil isang sachet lang ang kailangan para sa isang tangke o 16L ng tubig

📘 Need a full guide? Pwede ko i-PM sa'yo!
CONTEXT;

    public function __construct()
    {
        $this->mistralApiKey = env('MISTRAL_API_KEY');
        if (!$this->mistralApiKey) {
            Log::error('MISTRAL_API_KEY not found in environment variables');
        }
    }

    /**
     * Extract a labeled section from the full CONTEXT by heading label.
     * Returns text from the heading line up to (but excluding) the next heading or end.
     */
    private function extractSectionByLabel(string $label): string
    {
        $pattern = '/(^|\n)\s*' . preg_quote($label, '/') . '\s*(?:\r?\n)([\s\S]*?)(?=\n\s*(HERBICIDE|FUNGICIDE|BIOSTIMULANT|INSECTICIDE|MOLLUSCICIDE)\s*\r?\n|\z)/i';
        if (preg_match($pattern, $this->Context, $matches)) {
            // Return the matched body (group 2). Prepend the label to keep section context clear.
            $body = trim($matches[2] ?? '');
            return $label . "\n" . $body;
        }
        return '';
    }

    /**
     * Heuristically select the most relevant section(s) of CONTEXT based on user message.
     * Falls back to a broader search if no specific section matches.
    */
    private function buildRelevantContext(string $userMessage): string
    {
        $text = mb_strtolower($userMessage);

        $label = '';
        // Very lightweight keyword routing; extend as needed
        if (preg_match('/herbicide|action|residual|Diuron|soil|erosion|sloping|nutrition|foliar|sibuyas|umuulan|maisan|weed|weeds|damo|grass|cavendish|banana|rubber|oil|palm|industrial|rescue|dahon|gulay|application|glyph|pre-?emergent|post-?emergent/i', $userMessage)) {
            $label = 'HERBICIDE';
        } elseif (preg_match('/fungicide|purple|blotch|rust|mildew|gulayan|manganese|sakit|oil|rot|organic|blossom|blight|scab|streak|leaf|abono|palayan|mangga|fungal|amag|blight|mildew|anthracnose|bacterial/i', $userMessage)) {
            $label = 'FUNGICIDE';
        } elseif (preg_match('/biostimulant|potassium|panicle|fruit|drop|eco|friendly|organic|abiotic|sustansya|tagtuyot|chicken|manure|mag imbak|kalidad|amino acid|stress|shock|baha|nagpapabulas|vegetable|protien|tag-init|tag-ulan|malusog|nitrogen|fertilizer|pataba|booster|amino|urea/i', $userMessage)) {
            $label = 'BIOSTIMULANT';
        } elseif (preg_match('/insecticide|insect|insekto|moth|worm|peste|uod|moth|planthopper|bug|aphid/i', $userMessage)) {
            $label = 'INSECTICIDE';
        } elseif (preg_match('/molluscicide|snail|kuhol/i', $userMessage)) {
            $label = 'MOLLUSCICIDE';
        }

        // Debug logging to help troubleshoot matching issues
        Log::info('Context selection debug', [
            'user_message' => $userMessage,
            'selected_label' => $label,
            'message_lower' => $text
        ]);

        // If we found a specific section, use it
        if ($label !== '') {
            $section = $this->extractSectionByLabel($label);
            if ($section !== '') {
                // Hard cap to keep prompt small
                if (mb_strlen($section) > $this->maxContextChars) {
                    $section = mb_substr($section, 0, $this->maxContextChars);
                }
                return $section;
            }
        }

        // Fallback: search for any mention of keywords in the full context
        $fallbackContext = $this->searchContextForKeywords($userMessage);
        if ($fallbackContext !== '') {
            return $fallbackContext;
        }

        // If still no match, return empty - Mistral will use its fallback response
        return '';
    }

    /**
     * Search the full context for any mention of keywords from the user message.
     * Returns a small relevant snippet if found.
     */
    private function searchContextForKeywords(string $userMessage): string
    {
        $words = preg_split('/\s+/', mb_strtolower($userMessage));
        $words = array_filter($words, function($word) {
            return strlen($word) > 2; // Only consider words longer than 2 characters
        });

        if (empty($words)) {
            return '';
        }

        $context = $this->Context;
        $foundSnippets = [];

        // Search for each word in the context
        foreach ($words as $word) {
            $pattern = '/[^\n]*' . preg_quote($word, '/') . '[^\n]*/i';
            if (preg_match_all($pattern, $context, $matches)) {
                foreach ($matches[0] as $match) {
                    $foundSnippets[] = trim($match);
                }
            }
        }

        if (empty($foundSnippets)) {
            return '';
        }

        // Remove duplicates and limit to reasonable size
        $foundSnippets = array_unique($foundSnippets);
        $result = implode("\n", array_slice($foundSnippets, 0, 5)); // Max 5 snippets

        // Cap the result size
        if (mb_strlen($result) > $this->maxContextChars) {
            $result = mb_substr($result, 0, $this->maxContextChars);
        }

        return $result;
    }

    /**
     * Handles chat requests and returns Mistral AI responses based on herbicide context.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chat(Request $request)
    {
        try {
            // Check if API key is configured
            if (!$this->mistralApiKey) {
                Log::error('MISTRAL_API_KEY is not configured');
                return response()->json(['error' => 'Chat service is not properly configured. Please contact support.'], 500);
            }

            $userMessage = $request->input('message');
            // Build a minimal relevant context instead of sending the whole corpus
            $context = $this->buildRelevantContext($userMessage ?? '');
            if (empty($userMessage)) {
                return response()->json(['error' => 'Message is required'], 400);
            }
            // Concise system prompt to minimize tokens
            if (!empty($context)) {
                $systemPrompt = "Ikaw si Pandoy, LeadsAgri Bot. Sagutin sa Tagalog, maikli at malinaw. Gamitin ang impormasyon sa CONTEXT para sagutin ang tanong. Sagutin lang ang tanong gamit ang CONTEXT. Huwag maglagay ng fallback message.\n";
            } else {
                $systemPrompt = "Ikaw si Pandoy, LeadsAgri Bot. Sagutin sa Tagalog, maikli at malinaw. Kung hindi mo alam ang sagot, sabihin: '🤔 Uy, hindi ko masyadong na-gets 'yan, Ka-Leads. Please contact LeadsAgri for more details.'\n";
            }
            if (!empty($context)) {
                $systemPrompt .= "\nCONTEXT:\n" . $context;
            }
            // Cap output tokens to a small, adequate size to save usage
            $approxQuestionLen = mb_strlen($userMessage);
            $maxTokens = 220; // default small cap
            if ($approxQuestionLen < 120) {
                $maxTokens = 160;
            } elseif ($approxQuestionLen > 600) {
                $maxTokens = 280; // slight increase for long questions
            }

            $requestData = [
                'model' => 'mistral-small-latest',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userMessage]
                ],
                'temperature' => 0.4, // lower randomness keeps responses shorter and on-point
                'max_tokens' => $maxTokens
            ];
            Log::info('Sending request to Mistral API', [
                'url' => $this->mistralApiUrl,
                // Avoid logging full prompt to keep logs small and protect tokens
                'has_context' => !empty($context),
                'context_label' => !empty($context) ? (preg_match('/^(HERBICIDE|FUNGICIDE|BIOSTIMULANT|INSECTICIDE|MOLLUSCICIDE)/', $context, $m) ? $m[1] : 'unknown') : null,
                'max_tokens' => $maxTokens
            ]);
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->mistralApiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($this->mistralApiUrl, $requestData);

            Log::info('Mistral API response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            if ($response->successful()) {
                try {
                    $json = $response->json();
                    $choice = $json['choices'][0] ?? null;

                    if (!$choice) {
                        return response()->json(['error' => 'Invalid AI response format.'], 500);
                    }

                    // Check if the response was cut off due to token limit
                    if (isset($choice['finish_reason']) && $choice['finish_reason'] === 'length') {
                        $botResponse = "😅 Opps naubos na ang kakayahan ni Pandoy sumagot. Subukan mong paikliin ang tanong o hatiin ito sa mas maliliit na parte.";
                    } else {
                        $botResponse = $choice['message']['content'];
                    }

                    // Add your Main Menu button
                    $botResponse .= '<br><br>Type "MENU" o pindutin and MAIN MENU button para bumalik sa main options<br><br><button class="main-menu-btn" onclick="goToMainMenu()">Main Menu</button>';

                    return response()->json(['response' => $botResponse]);
                } catch (\Exception $e) {
                    Log::error('Response parsing error: ' . $e->getMessage() . "\n" . $response->body());
                    return response()->json(['error' => 'Error parsing response from AI model.'], 500);
                }
            }
        } catch (\Exception $e) {
            $errorMessage = 'Chat error: ' . $e->getMessage() . "\n" . $e->getTraceAsString();
            Log::error($errorMessage);
            return response()->json(['error' => 'An error occurred while processing your request: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get FAQ endpoint (placeholder method)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFAQ()
    {
        return response()->json(['message' => 'FAQ endpoint']);
    }

    /**
     * Test endpoint to verify the controller is working
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function test()
    {
        return response()->json([
            'message' => 'ChatController is working',
            'api_key_configured' => !empty($this->mistralApiKey),
            'timestamp' => now()
        ]);
    }
}
