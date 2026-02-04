@echo off
echo ==========================================
echo FIXING HOSTS FILE FOR CODE360
echo ==========================================
echo.

:: Check for Admin privileges
net session >nul 2>&1
if %errorLevel% == 0 (
    echo Success: Running as Administrator.
) else (
    echo ERROR: NOT RUNNING AS ADMINISTRATOR.
    echo Please Right-Click this file and select "Run as administrator".
    pause
    exit
)

echo.
echo Adding code360.test to hosts file...
echo. >> C:\Windows\System32\drivers\etc\hosts
echo 127.0.0.1 code360.test >> C:\Windows\System32\drivers\etc\hosts
echo ::1 code360.test >> C:\Windows\System32\drivers\etc\hosts

echo.
echo ==========================================
echo DONE!
echo Please Restart your WAMP Server now.
echo ==========================================
pause
