#!/bin/bash
source /scripts/utils.sh

run_script() {
    local SCRIPT_NAME="$1"
    print_title "Running $SCRIPT_NAME"
    bash "/scripts/$SCRIPT_NAME.sh"
}

main(){
    print_info "Running bootstrap scripts"
    run_script "create-bucket"
}

main
