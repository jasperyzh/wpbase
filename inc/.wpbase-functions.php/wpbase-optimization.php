<?php

/**
 * wpbase_optimization
 * 
 */

// optimization
// generally refers to getting app/scripts to run as fast as possible

// scaling
// building an app that can handle more stuff

// scalability
// subjective measure of how well code and app handles more and bigger stuff

// origin
// refers to wordpress application, which is the source of all of the data coming out of your app

// edge
// refers to services outside of wordpress application, further from the origin but potentially closer to users (CDNs)

// Varnish, sound like CDN, serving static-files


// testing
// what to test?
/**
 * 1. test a static page as benchmark
 * 
 * 2. test pages wit all outside page caches and accelerators turned off
 * 
 * 3. test pages with all outside page caches and accelerators turned on
 * 
 * 4. test prototypical pages - kind of page users are most likely to interact with
 * 
 * 5. test atypical pages
 * 
 * 6. test URLs in groups - tools like Siege and Blitz.io allows to specify a list of URLs. get a better idea what kind of traffic the site can handle
 * 
 * 7. test URLs by themselves
 * 
 * 8. test app from locations outside your webserver
 * 
 * 9. test app from inside your webserver
 * 
 * // check Chrome Devtool
 * 
 * Tool: Apache Bench
 * // yum install httpd-tools
 * // apt-get install apache2-utils
 * 
 * // ab -n 1000 -c 100 http://yourdomain.com/index.php
 * 
 * graphing apace bench results with gnuplot
 * 
 * Tool: Siege
 * - like apache benchmark, hit site with multiple simultaneous connection and record response times
 * 
 * http://www.joedog.org/siege-home/
 * 
 * // siege -b -c100 -d20 -t2M http://yourdomain.com
 * 
 * Tool: Blitz.io (discontinued)
 * - web server for running benchmarks against your websites and webapps
 * 
 * Tool: W3 Total Cache
 */
