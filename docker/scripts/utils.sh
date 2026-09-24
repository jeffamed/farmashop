#!/bin/bash

print_title(){
    echo ""
    echo "====================================="
    echo "$1"
    echo "====================================="
    echo ""
}

print_success(){
   echo -e "[INFO] $1" >&2
}

print_error(){
    echo -e "❌ $1" >&2
}

print_info(){
    echo -e "ℹ️ $1" >&2
}

check_last_command() {
  if [ $? -eq 0 ]; then
    print_success "$1"
  else
    print_error "$2"
    exit 1
  fi
}

save_variable() {
    local KEY=$1
    local VALUE=$2
    local FILE="./scripts/state/.bootstrap.env"

    mkdir -p ./scripts/state

    touch "$FILE"

    if grep -q "^${KEY}=" "$FILE"; then
        sed -i "s|^${KEY}=.*|${KEY}=${VALUE}|" "$FILE"
    else
        echo "${KEY}=${VALUE}" >> "$FILE"
    fi
}