<?php
/**
 * Create 7 test blog posts for SEO testing
 * Run this once then delete the file
 */

// Load WordPress
require_once( dirname( __FILE__ ) . '/../../wp-load.php' );

$posts = array(
    array(
        'title'    => 'Mastering SEO: A Complete Guide to Search Engine Optimization',
        'category' => 'SEO',
        'excerpt'  => 'Learn the fundamentals of SEO and how to rank higher in search engines with proven strategies.',
        'content'  => 'Search Engine Optimization (SEO) is the practice of improving your website to increase its visibility when people search for products, services, or information related to your business in Google, Bing, and other search engines. The better visibility your pages have in search results, the more likely you are to garner attention and attract prospective and existing customers to your business.

Higher search rankings require a multi-faceted approach that includes technical optimization, content strategy, and link building. In this comprehensive guide, we\'ll cover everything you need to know to get started with SEO and improve your online presence.

The first step in SEO is to understand what your audience is searching for and the keywords they use. Once you identify these keywords, you can create content that addresses their needs and incorporates these terms naturally. Remember, SEO is not about tricking search engines—it\'s about creating valuable content that serves both users and search algorithms.

Technical SEO ensures that search engines can crawl and index your website properly. This includes optimizing your site\'s speed, mobile responsiveness, and URL structure. On-page SEO involves optimizing individual pages with proper heading tags, meta descriptions, and keyword placement.

Finally, off-page SEO like link building and social signals help establish your site\'s authority. By implementing these strategies consistently, you\'ll see improvements in your search rankings over time.',
        'image'    => 'img-s-20.webp',
    ),
    array(
        'title'    => 'Keyword Research: Finding the Perfect Terms for Your Content',
        'category' => 'SEO',
        'excerpt'  => 'Discover how to conduct effective keyword research to drive more traffic to your website.',
        'content'  => 'Keyword research is the foundation of any successful SEO strategy. It involves identifying the words and phrases that your target audience uses when searching for products, services, or information related to your business.

Effective keyword research helps you understand your audience\'s search intent, competition levels, and traffic potential. Tools like Google Keyword Planner, Ahrefs, and SEMrush can help you identify relevant keywords with good search volume and low competition.

When conducting keyword research, look for a mix of high-volume keywords (head terms) and long-tail keywords (3+ word phrases). Long-tail keywords often have less competition and higher conversion rates because they\'re more specific to user intent.

Analyze your competitors\' keywords to identify gaps and opportunities. Look at what keywords they\'re ranking for and find variations or related terms they might have missed. This competitive analysis can reveal untapped opportunities in your niche.

Remember that keyword research is not a one-time activity. Search trends change, and new keywords emerge constantly. Regularly review and update your keyword strategy to stay ahead of the competition.',
        'image'    => 'img-s-21.webp',
    ),
    array(
        'title'    => 'On-Page SEO: Optimize Your Pages for Better Rankings',
        'category' => 'SEO',
        'excerpt'  => 'Learn how to implement on-page SEO best practices to improve your search engine visibility.',
        'content'  => 'On-page SEO refers to the practice of optimizing individual web pages to rank higher in search results and attract more relevant traffic. It includes both the content on the page and the HTML source code.

Key on-page SEO elements include:

Title Tags: Create compelling, keyword-rich title tags (50-60 characters) that accurately describe your page content. The title tag is one of the most important on-page factors.

Meta Descriptions: Write descriptive meta descriptions (150-160 characters) that encourage clicks from search results. While not a direct ranking factor, a good meta description improves click-through rates.

Heading Tags: Use heading tags (H1, H2, H3) to organize your content hierarchically. Include your target keyword in the H1 tag, and use related keywords in subheadings.

URL Structure: Create clean, descriptive URLs that include your target keyword. Avoid using numbers or special characters that don\'t contribute to understanding the page topic.

Internal Linking: Link to other relevant pages on your website using descriptive anchor text. Internal linking helps distribute page authority and establishes information hierarchy.

Content Quality: Create comprehensive, valuable content that answers user questions and provides actionable insights. Content should be original, well-researched, and optimized for readability.

Image Optimization: Use descriptive file names and alt text for images. Optimize image file sizes to improve page load speed.

By implementing these on-page SEO best practices, you\'ll create a solid foundation for search engine visibility.',
        'image'    => 'img-s-22.webp',
    ),
    array(
        'title'    => 'Link Building Strategies: Boost Your Website Authority',
        'category' => 'SEO',
        'excerpt'  => 'Explore effective link building techniques to increase your domain authority and search rankings.',
        'content'  => 'Link building is the process of acquiring hyperlinks from external websites to your own. Links act as votes of confidence, and websites with more quality links tend to rank higher in search results.

Quality matters more than quantity when it comes to links. A single link from a high-authority website in your industry is more valuable than dozens of links from low-quality sites.

Effective link building strategies include:

Guest Posting: Write articles for reputable websites in your industry. This allows you to showcase your expertise while earning a link back to your website.

Broken Link Building: Find broken links on relevant websites and offer your content as a replacement. This provides value to the website owner while earning a link.

Resource Pages: Create comprehensive resource guides that other websites will want to link to. These become natural link magnets in your industry.

Digital PR: Generate press coverage and mentions for your business, which often result in valuable links and brand visibility.

Skyscraper Technique: Find popular content in your niche and create a better, more comprehensive version. Then reach out to websites linking to the original content.

Relationship Building: Develop genuine relationships with other website owners and influencers in your industry. Strong relationships lead to natural linking opportunities.

Remember that search engines penalize manipulative link building practices like buying links or participating in link schemes. Focus on earning links through creating exceptional content and building genuine relationships.',
        'image'    => 'img-s-23.webp',
    ),
    array(
        'title'    => 'Technical SEO: The Foundation of a Search-Friendly Website',
        'category' => 'SEO',
        'excerpt'  => 'Understand the technical aspects of SEO that ensure your website is fully optimized for search engines.',
        'content'  => 'Technical SEO encompasses the behind-the-scenes elements that help search engines crawl, index, and rank your website. While technical SEO might seem complex, it\'s essential for laying a strong foundation for your overall SEO strategy.

Key technical SEO elements include:

Site Speed: Page load speed is a ranking factor and impacts user experience. Optimize images, minimize CSS and JavaScript, and use caching to improve speed.

Mobile Responsiveness: With mobile-first indexing, Google prioritizes mobile versions of websites. Ensure your site is fully responsive and provides an excellent experience on all devices.

XML Sitemaps: Create and submit XML sitemaps to help search engines discover all your pages. Update sitemaps whenever you add new content.

Robots.txt: Use your robots.txt file to guide search engines on which pages to crawl and index. This prevents wasting crawl budget on less important pages.

SSL Certificate: Use HTTPS to secure your website. Google gives a slight ranking boost to HTTPS websites and displays a security indicator in browsers.

Canonical Tags: Use canonical tags to specify which version of a page should be indexed when you have duplicate or similar content.

Structured Data: Implement schema markup to help search engines understand your content better. This can improve rich snippets in search results.

Site Architecture: Organize your website logically with a clear hierarchy. A well-structured site helps search engines understand relationships between pages.

By addressing these technical SEO factors, you\'ll create a website that search engines can efficiently crawl and index.',
        'image'    => 'img-s-24.webp',
    ),
    array(
        'title'    => 'Content Strategy for SEO: Creating Content That Ranks',
        'category' => 'SEO',
        'excerpt'  => 'Develop a content strategy that combines SEO best practices with genuine value for your audience.',
        'content'  => 'A successful SEO strategy is built on a foundation of high-quality, relevant content. Content strategy for SEO involves planning and creating content that addresses your audience\'s needs while incorporating target keywords and SEO best practices.

Start with audience research to understand your target customer\'s pain points, questions, and search behavior. Use this insight to create a content calendar that addresses these needs across different stages of the buyer\'s journey.

Content pillars are broad topics that define your expertise and authority in your industry. Create multiple pieces of content around each pillar to establish comprehensive coverage and internal linking opportunities.

When creating content for SEO:

Write for Users First: Create content that\'s valuable and informative for your audience. Search engines increasingly reward user-focused content.

Incorporate Keywords Naturally: Use your target keyword and related terms naturally throughout your content. Avoid keyword stuffing, which can harm your rankings.

Use Clear Structure: Organize content with descriptive headings, subheadings, bullet points, and short paragraphs for easy scanning and reading.

Provide Comprehensive Answers: Create content that thoroughly answers user questions and provides actionable insights. Longer, more comprehensive content often performs better in search results.

Update Regularly: Keep your content fresh and up-to-date. Outdated information can harm your credibility and rankings. Consider updating evergreen content periodically.

Optimize for Intent: Match your content to search intent. If users are looking for quick answers, provide concise, direct information. If they\'re researching in-depth, provide comprehensive guides.

Content strategy combined with technical SEO and link building creates a powerful approach to improving your search visibility.',
        'image'    => 'img-s-25.webp',
    ),
    array(
        'title'    => 'SEO Analytics: Measuring and Improving Your Performance',
        'category' => 'SEO',
        'excerpt'  => 'Learn how to track, measure, and optimize your SEO efforts using analytics and data.',
        'content'  => 'SEO is not a set-and-forget activity. Successful SEO requires ongoing monitoring, analysis, and optimization based on data and performance metrics.

Essential SEO metrics to track include:

Organic Traffic: Monitor the volume of traffic coming from search engines. Track trends over time to measure the impact of your SEO efforts.

Keyword Rankings: Track your rankings for target keywords. Use tools like Google Search Console and third-party SEO tools to monitor ranking changes.

Click-Through Rate: Analyze your click-through rate (CTR) from search results. Improve your title tags and meta descriptions to increase CTR.

Bounce Rate: Monitor how many visitors leave your site after viewing only one page. High bounce rates might indicate that content doesn\'t match search intent.

Conversion Rate: Track how many organic visitors complete desired actions like form submissions or purchases. This measures the true ROI of your SEO efforts.

Backlink Profile: Monitor your backlinks using tools like Ahrefs or SEMrush. Track new links, lost links, and anchor text distribution.

Page Speed: Regularly monitor your page speed using Google PageSpeed Insights or similar tools. Speed improvements can positively impact rankings and user experience.

Use Google Search Console to see how your site appears in search results, identify indexing issues, and get suggestions for improvement. Google Analytics provides detailed information about your traffic, user behavior, and conversions.

Regularly review these metrics, identify trends and patterns, and make data-driven decisions to continuously improve your SEO performance. Testing different strategies and measuring results is key to long-term success.',
        'image'    => 'img-s-20.webp',
    ),
);

foreach ( $posts as $post_data ) {
    $post = wp_insert_post( array(
        'post_type'    => 'post',
        'post_status'  => 'publish',
        'post_title'   => $post_data['title'],
        'post_content' => $post_data['content'],
        'post_excerpt' => $post_data['excerpt'],
    ) );

    if ( ! is_wp_error( $post ) ) {
        // Add category
        $cat = get_term_by( 'name', $post_data['category'], 'category' );
        if ( $cat ) {
            wp_set_post_categories( $post, $cat->term_id );
        } else {
            $cat = wp_insert_term( $post_data['category'], 'category' );
            if ( ! is_wp_error( $cat ) ) {
                wp_set_post_categories( $post, $cat['term_id'] );
            }
        }

        // Set featured image from existing blog images
        $image_url = ONDIGITAL_URI . '/assets/imgs/blog/' . $post_data['image'];

        // Try to attach an existing image or create from URL
        $attachment_id = attachment_url_to_postid( $image_url );
        if ( $attachment_id ) {
            set_post_thumbnail( $post, $attachment_id );
        }

        echo "✓ Created: {$post_data['title']}\n";
    } else {
        echo "✗ Failed: {$post_data['title']}\n";
    }
}

echo "\n✅ Blog posts created successfully!\n";
echo "🔗 View them here: " . home_url( '/blog/' ) . "\n";
