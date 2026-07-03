resource "aws_s3_bucket" "planet_shopify_demo" {
  bucket = "planet-shopify-demo-${random_id.bucket_suffix.hex}"
}

resource "random_id" "bucket_suffix" {
  byte_length = 4
}

output "bucket_name" {
  value = aws_s3_bucket.planet_shopify_demo.bucket
}
resource "aws_s3_bucket_website_configuration" "website" {
  bucket = aws_s3_bucket.planet_shopify_demo.id

  index_document {
    suffix = "index.html"
  }
}
