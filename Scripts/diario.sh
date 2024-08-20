#!/bin/bash
zip -rq /backup/usb/pessoais/diario/diario_$(date +"%Y_%m_%d").zip /backup/usb/www/diario
mysqldump -uroot diario diarios > /backup/usb/pessoais/diario/diario_$(date +"%Y_%m_%d").sql
