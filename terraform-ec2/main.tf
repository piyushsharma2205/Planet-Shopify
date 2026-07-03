resource "aws_instance" "planet_shopify_server" {
  ami                         = "ami-020cba7c55df1f615"
  instance_type               = var.instance_type
  subnet_id                   = "subnet-0766a33f6e2c0e330"
  associate_public_ip_address = true
  vpc_security_group_ids      = [aws_security_group.planet_shopify_sg.id]

  user_data = <<-EOF
#!/bin/bash
apt update -y
apt install nginx -y
systemctl enable nginx
systemctl start nginx
EOF

  tags = {
    Name = "Planet-Shopify-Terraform"
  }
}
resource "aws_security_group" "planet_shopify_sg" {
  name        = "planet-shopify-sg"
  description = "Allow SSH and HTTP"

  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = {
    Name = "planet-shopify-sg"
  }
}
