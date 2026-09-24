#!/bin/bash

source /scripts/utils.sh

print_title "Creating bucket"

BUCKET_NAME="farmashop"
URL="http://floci:4566"

aws s3 ls --endpoint-url "$URL" | grep -q "$BUCKET_NAME"

if [ $? -ne 0 ]; then
    print_info "Creating bucket $BUCKET_NAME"
    aws s3 mb s3://"$BUCKET_NAME" --endpoint-url "$URL"
else
    print_info "Bucket $BUCKET_NAME already exists"
fi
