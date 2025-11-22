#!/bin/bash

# Static Site Generator for Netlify
# This script generates static HTML from the running Laravel site

set -e

echo "🌊 Santa Cruz Whale Watching - Static Site Generator"
echo "=================================================="

# Configuration
LOCAL_URL="http://localhost:8000"
OUTPUT_DIR="static-site"
PUBLIC_DIR="public"

# Check if Laravel server is running
echo "📡 Checking if Laravel server is running..."
if ! curl -s -o /dev/null -w "%{http_code}" $LOCAL_URL | grep -q "200"; then
    echo "❌ Error: Laravel server is not running at $LOCAL_URL"
    echo "Please start it with: php artisan serve"
    exit 1
fi
echo "✅ Server is running"

# Clean up old static site
echo "🧹 Cleaning up old static files..."
rm -rf $OUTPUT_DIR
mkdir -p $OUTPUT_DIR

# Use wget to crawl the site and generate static files
echo "🕷️  Crawling site and generating static HTML..."
wget \
    --recursive \
    --no-clobber \
    --page-requisites \
    --html-extension \
    --convert-links \
    --restrict-file-names=windows \
    --domains localhost \
    --no-parent \
    --directory-prefix=$OUTPUT_DIR \
    --execute robots=off \
    --wait=0.2 \
    --random-wait \
    --user-agent="StaticSiteGenerator/1.0" \
    $LOCAL_URL

# Move files from localhost:8000 directory to root
echo "📁 Organizing files..."
if [ -d "$OUTPUT_DIR/localhost:8000" ]; then
    mv $OUTPUT_DIR/localhost:8000/* $OUTPUT_DIR/
    rmdir $OUTPUT_DIR/localhost:8000
fi

# Copy static assets from public directory that wget might have missed
echo "📦 Copying additional static assets..."
mkdir -p $OUTPUT_DIR/images
mkdir -p $OUTPUT_DIR/css
mkdir -p $OUTPUT_DIR/js
mkdir -p $OUTPUT_DIR/uploads
mkdir -p $OUTPUT_DIR/thumbs

# Copy images, uploads, thumbs if they exist
if [ -d "$PUBLIC_DIR/images" ]; then
    cp -r $PUBLIC_DIR/images/* $OUTPUT_DIR/images/ 2>/dev/null || true
fi
if [ -d "$PUBLIC_DIR/uploads" ]; then
    cp -r $PUBLIC_DIR/uploads/* $OUTPUT_DIR/uploads/ 2>/dev/null || true
fi
if [ -d "$PUBLIC_DIR/thumbs" ]; then
    cp -r $PUBLIC_DIR/thumbs/* $OUTPUT_DIR/thumbs/ 2>/dev/null || true
fi

# Copy other important files
cp $PUBLIC_DIR/robots.txt $OUTPUT_DIR/ 2>/dev/null || true
cp $PUBLIC_DIR/sitemap.xml $OUTPUT_DIR/ 2>/dev/null || true
cp $PUBLIC_DIR/favicon.ico $OUTPUT_DIR/ 2>/dev/null || true
cp $PUBLIC_DIR/BingSiteAuth.xml $OUTPUT_DIR/ 2>/dev/null || true

# Create _redirects file for Netlify (for clean URLs)
echo "🔀 Creating Netlify redirects..."
cat > $OUTPUT_DIR/_redirects << 'EOF'
# Netlify redirects for clean URLs
/*    /index.html   200
EOF

echo ""
echo "✅ Static site generation complete!"
echo "📂 Output directory: $OUTPUT_DIR"
echo ""
echo "Next steps:"
echo "1. Review the generated files in ./$OUTPUT_DIR"
echo "2. Initialize git: cd $OUTPUT_DIR && git init"
echo "3. Add and commit: git add . && git commit -m 'Initial static site'"
echo "4. Deploy to Netlify from the $OUTPUT_DIR directory"
echo ""
