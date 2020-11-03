#!/usr/bin/env sh

mkdir -p config/jwt

#openssl genrsa -aes256 -passout pass:"$JWT_PASSPHRASE" -out config/jwt/private.pem 4096
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096

#openssl rsa -passin pass:"$JWT_PASSPHRASE" -pubout -in config/jwt/private.pem -out config/jwt/public.pem
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout

chmod -R 644 config/jwt/*
