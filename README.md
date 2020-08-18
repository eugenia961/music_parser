# Backend Developer 

Product Vision of the "musicParser Application" is a parser application form XML  without databases.

The source of the data is a XML document  musicParser/public/worldofmusic.xml.
```
<records>
  <record>
    <title>Anthology of American Folk Music, Vol. 1-3 - Disk 1</title>
    <name>Anthology of American Folk Music, Vol. 1-3 - Disk 1</name>
    <genre>Folk</genre>
    <releasedate>1997.08.19</releasedate>
    <label>Smithsonian/Folkways</label>
    <formats>CD</formats>
    <tracklisting>
      <track>Henry Lee</track>
      <track>Fatal Flower Garden</track>
      <track>House Carpenter</track>
      <track>Drunkard's Special</track>
      <track>Old Lady And The Devil</track>
      <track>Butcher's Boy (The Railroad Boy)</track>
      <track>Wagoner's Lad</track>
      <track>King Kong Kitchie Kitchie Ki-Me-O</track>
      <track>Old Shoes And Leggins</track>
      <track>Willie Moore</track>
      <track>Lazy Farmer Boy</track>
      <track>Peg and Awl</track>
      <track>Omie Wise</track>
      <track>My Name Is John Johanna</track>
    </tracklisting>
  </record>
  <record>
    <title>Century Media 10th Anniversary Box Set Collection - Disk 1</title>
    <name>Century Media 10th Anniversary Box Set Collection - Disk 1</name>
    <genre>Rock</genre>
    <releasedate>2001.11.13</releasedate>
    <label>Century Media/Caroline</label>
    <formats>CD</formats>
    <tracklisting>
      <track>.44 Caliber Brain Surgery</track>
      <track>See The Signs</track>
      <track>Sister Fucker (Part1</track>
      <track>Master Killer</track>
      <track>No Eden</track>
      <track>The Hunter</track>
      <track>Oh My Fucking God</track>
      <track>Black</track>
      <track>Rising</track>
      <track>White Worms</track>
      <track>Second Skin</track>
      <track>Playing Dead</track>
      <track>Soul Devourer</track>
      <track>Of One Blood</track>
      <track>The River Dragon Has Come</track>
      <track>Confessions Of A Lesser Known Saint</track>
      <track>Broken Promise</track>
      <track>Without Water</track>
    </tracklisting>
  </record>
</records>
```

Return a  list of releases with more than 10 tracks and a release date before 01/01/2001.

The output is a XML in the next format store in the stored in the filesystem (no database is used):
```
<matchingReleases>
<release>
<name>Cutting Edge</name>
<trackCount>12</trackCount>
</release>
<release>
<name>Physical Graffiti</name>
<trackCount>15</trackCount>
</release>
</matchingReleases>
```


## Languages

PHP 7.2

## Frameworks

Symfony 4


## Usage

Inside the musicParser directory run the command:

```
php bin/console record_command

```

The command return the path of the releases file that is inside public directory:

Example:

```
The file path is: musicParser/public/worldofmusicrelease2019071718094848.xml

```

## TEST

Inside the musicParser directory run the command:

```
./vendor/bin/simple-phpunit

```

##Docker
Up
```
docker-compose  up
```
Log
```
docker logs --tail 50 --follow --timestamps music-parser
```
Down
```
docker-compose down --rmi all
```
Volume rm
```
docker volume rm music_parser_nfsmount_music
```
Error: Failed to mount local volume: mount :nfsmount_music/_data, data: addr=192.168.65.2,nolock,hard,nointr,nfsvers=3: permission denied
```
sudo cat /etc/exports

```
Add line
```
/Users/eus/Project/music_parser/src/music_parser -alldirs -mapall=284861999:550037180 localhost

```
```
sudo nfsd restart
```