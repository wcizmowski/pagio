pagio application
--

<i>pagio = page input/output ;-)</i>
![This is an image](https://pagio.iwebi.pl/build/assets/images/technology-6701504_640.jpg)



pagio app is based on Symfony 6.1<br>
PHP version 8.1

Features:
* web page analyse /CSS classes/
* API enpoint version /additional feature/

Introduction
--
****The application is a recruitment task for the provider group company.****
An application based on the Symfony framework was created
along with an element of type api endpoint, which retrieves the content of the indicated
html page and looks for an html element with a specific css class in it or informs about the lack of them
The end point result returns a json array with the following structure:
<br>
```
  {
    'url',
    'http_reposne_code',
    'elements' = {
      array of found items,
    }
  }
```
Instalation & Start-up
--

The project is on GitHub at:<br>
https://github.com/wcizmowski/pagio
<br>To download the project, run the command:<br>
```
git clone git@github.com:wcizmowski/pagio.git
```
Once downloaded, run the following command in the project directory:
```
composer install
```
These steps are enough to initialize correctly.

To run, Generally, two scenarios are possible:
1. Using the so-called Symfony Local Web Server
2. Using docker /preferred/.

#### 1. Symfony Local Web Server
The Symfony server is started once per project, so you may end up with several instances (each of them listening to a different port). This is the common workflow to serve a Symfony project:

```
cd project/
symfony server:start
[OK] Web server listening on http://127.0.0.1:....
...

symfony open:local
```
All details are described here:
https://symfony.com/doc/current/setup/symfony_server.html
#### 2. Start with docker
After completing the steps described in Quick start, you should:
in the file:
````
Linux:
/etc/hosts Linux
windows
C:\Windows\System32\drivers\etc\hosts
add the IP, in this case it will be 127.0.0.1

Then add the htdocs link in the root of the project
Linux:
ln -s /public htdocs
Windows:
you can ls do it in docker after login.
````
#### Quick start

<table width="100%" style="width:100%; display:table;">
 <thead>
  <tr>
   <th width="50%" style="width:50%;">Linux and MacOS</th>
   <th width="50%" style="width:50%;">Windows</th>
  </tr>
 </thead>
 <tbody style="vertical-align: bottom;">
  <tr>
   <td>
<div class="highlight highlight-source-shell"><pre># Get the Devilbox
git clone https://github.com/cytopia/devilbox</pre></div>
<div class="highlight highlight-source-shell"><pre># Create docker-compose environment file
cd devilbox
cp env-example .env</pre></div>
<div class="highlight highlight-source-shell"><pre># Edit your configuration
vim .env</pre></div>
<div class="highlight highlight-source-shell"><pre># Start all container
docker-compose up</pre></div>
   </td>
   <td>
    1. Clone <code>https://github.com/cytopia/devilbox</code> to <code>C:\devilbox</code> with <a href="https://git-scm.com/downloads">Git for Windows</a><br/><br/>
    2. Copy <code>C:\devilbox\env-example</code> to <code>C:\devilbox\.env</code><br/><br/>
    3. Edit <code>C:\devilbox\.env</code><br/><br/>
    4. <a href="https://devilbox.readthedocs.io/en/latest/howto/terminal/open-terminal-on-win.html">Open a terminal on Windows</a> and type:<br/><br/><br/>
    <pre># Start all container
C:\devilbox> docker-compose up</pre></div>
   </td>
  </tr>
 </tbody>
</table>

> **Documentation:**
> [Install the Devilbox](https://devilbox.readthedocs.io/en/latest/getting-started/install-the-devilbox.html) |
> [Start the Devilbox](https://devilbox.readthedocs.io/en/latest/getting-started/start-the-devilbox.html) |
> [.env file](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html)

#### Selective start

The above will start all containers, you can however also just start the containers you actually need. This is achieved by simply specifying them in the docker-compose command.

```bash
docker-compose up httpd php mysql redis
```
> **Documentation:**
> [Start only some container](https://devilbox.readthedocs.io/en/latest/getting-started/start-the-devilbox.html#start-some-container)

Usage
--
On the main page of the project we have 2 options:
1. Form with URL field for analysis
   Here we enter the URL and click the Analyze button, the results in JSON format will appear on the page.
2. The tab with the API address - classic endpoint.
   You can call endpoint /analyzeAPI?url=urltoanalyze directly

For preview purposes, the project has been posted online at:
https://pagio.iwebi.pl
