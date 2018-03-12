# PHP-LiveStreaming-Library

PHP Library to Stream Any Stored Video File Format to RTMP or RTMPS URL. Developed by Sohail Haider sohailh343@gmail.com & Akif Quddus akifquddus@gmail.com

## Start Stream

Send a POST Request to:
http://yourstreamingserver.com/stream/startstream

```php
{
    'source': '//bucketvideos.s3.amazonaws.com/Video4.mp4',
    'destination: 'rtmps://live-api-a.facebook.com:443/rtmp/1840118365998379?ds=1&s_sw=0&a=ATjIps5N8axKP4bu'
}
```
### Success
```json
{
    "status": true,
    "PID": 27013,
    "source": "https://bucketvideos.s3.amazonaws.com/Video4.mp4",
    "destination": "rtmps://live-api-a.facebook.com:443/rtmp/1840118365998379?ds=1&s_sw=0&a=ATjIps5N8axKP4bu"
}

## Server Requirements

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.


## License

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

## Resources

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_
