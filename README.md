# PHP-script-to-detect-Tor
This script in PHP can detect if the user use Tor nework to access to the servor.
## How it work
This script make a request to https://check.torproject.org/cgi-bin/TorBulkExitList.py, hosted by the official Tor Project website. This page give the list of all potential Tor Exit Node which can access to the servor.

## What he does ?
During his first execution, he create the session called "Tor" and store a booleen (true if the IP come from Tor network).
If the session already exist, it will skip the test.

This script allow two GET values :

?display=myIP will print the result of the test "My IP (XXX.XXX.XXX.XXX) is NOT Tor Exit Node." or "My IP (XXX.XXX.XXX.XXX) is Tor Exit Node.".

?display=full will print the response of the Tor's website and will display all Tor Exit Node from the past 16 hours that can contact your servor address on port 80.

In these two case, it will make a test even if it's not the first execution of the script.

## What if the Tor Website is unreachable ?

The script will trigger a PHP user Warnig.

## Is this ok for the privacy of my visitors ?
Yes. The only information you give to the Tor Website is the IP adress of your servor. The check is made on your servor.

## How to install ?
You have to download Tor.php, it's all.

## Can I use this script ?
Yes, since it's published under the MIT licence. If you use this script or have some suggestions, please contact me.
