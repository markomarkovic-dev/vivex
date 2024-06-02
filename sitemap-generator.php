<?php
require_once 'config.php';

// Define the API endpoints URLs and their corresponding URL patterns
$api_url_patterns = array(
    "$backendUrl/wp-json/wp/v2/proizvodi" => "proizvod?id=",
);

// Define the languages
$languages = array('sr', 'en', 'ba');

function updateSitemapFromAPIs($apiUrlPatterns, $languages) {
    global $siteUrl;

    // Load the existing sitemap.xml file if it exists
    $sitemapFile = 'sitemap.xml';
    if (file_exists($sitemapFile)) {
        // Read the current content of the sitemap file
        $currentContent = file_get_contents($sitemapFile);

        // Find the start and end positions of the comment blocks
        $startPos = strpos($currentContent, '<!-- PostUrl - start -->');
        $endPos = strpos($currentContent, '<!-- PostUrl - end -->');

        if ($startPos !== false && $endPos !== false) {
            // Extract the content before and after the comment blocks
            $beforeComment = substr($currentContent, 0, $startPos);
            $afterComment = substr($currentContent, $endPos + strlen('<!-- PostUrl - end -->'));

            // Initialize a string to store the new URLs
            $newUrls = '';

            foreach ($apiUrlPatterns as $apiUrl => $urlPattern) {
                // Initialize cURL session
                $ch = curl_init();

                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Execute the cURL request and get the response
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'Curl error: ' . curl_error($ch);
                    exit;
                }

                // Close cURL session
                curl_close($ch);

                // Parse the JSON response
                $posts = json_decode($response);

                // Loop through the posts and add new URL elements to the sitemap
                foreach ($posts as $post) {
                    $encodedPart = urlencode($post->slug); // Assuming the Cyrillic characters are in the slug

                    foreach ($languages as $language) {
                        $newUrl = "<url><loc>https://vivex.ba/" . $language . "/" . $urlPattern . $encodedPart . "</loc></url>\n";

                        // Add the new URL to the list
                        $newUrls .= $newUrl;
                    }
                }
            }

            // Reconstruct the sitemap content with the new URLs
            $newContent = $beforeComment . '<!-- PostUrl - start -->' . $newUrls . '<!-- PostUrl - end -->' . $afterComment;

            // Save the updated sitemap.xml file
            file_put_contents($sitemapFile, $newContent);

            // Output a success message
            echo 'Sitemap.xml updated successfully with new links.';
        } else {
            echo 'Error: Start or end comment not found in sitemap.xml.';
        }
    } else {
        echo 'Error: Sitemap.xml not found.';
    }
}

updateSitemapFromAPIs($api_url_patterns, $languages);
?>
