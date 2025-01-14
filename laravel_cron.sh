#!/bin/bash

# Navigate to the Laravel project directory
cd /home/launchpad.swipeloan.in/public_html

# Get the current hour in 24-hour format
current_hour=$(date +"%H")

# Run emiNotification:send at 10 AM
if [ "$current_hour" -eq "10" ]; then
    php artisan emiNotification:send
fi

# Run emiReminder:send at 11 AM
if [ "$current_hour" -eq "11" ]; then
    php artisan emiReminder:send
fi

# Run nocDocument:send at 9 AM
if [ "$current_hour" -eq "09" ]; then
    php artisan nocDocument:send
fi

# Run apply:bounce_charges at 10 AM
if [ "$current_hour" -eq "10" ]; then
    php artisan apply:bounce_charges
fi

# Check if the queue worker is running and start it if not
process_name="queue:work"
is_running=$(pgrep -f "$process_name")

#!/bin/bash

# Navigate to the Laravel project directory
cd /home/launchpad.swipeloan.in/public_html

# Get the current hour in 24-hour format
current_hour=$(date +"%H")

# Run emiNotification:send at 10 AM
if [ "$current_hour" -eq "10" ]; then
    php artisan emiNotification:send
fi

# Run emiReminder:send at 11 AM
if [ "$current_hour" -eq "11" ]; then
    php artisan emiReminder:send
fi

# Run nocDocument:send at 9 AM
if [ "$current_hour" -eq "09" ]; then
    php artisan nocDocument:send
fi

# Run apply:bounce_charges at 10 AM
if [ "$current_hour" -eq "10" ]; then
    php artisan apply:bounce_charges
fi

# Check if the queue worker is running and start it if not
process_name="queue:work"
is_running=$(pgrep -f "$process_name")

if [ -z "$is_running" ]; then
    nohup php artisan queue:work --tries=3 > /dev/null 2>&1 &
fi

