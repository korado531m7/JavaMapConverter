# JavaMapConverter
**Convert Maps of Java Edition to Bedrock Edition asynchronously with ease!**


## Feature
Blocks and sign texts (json formatted) will be converted for bedrock edition.
Conversion will be started when the chunks are loaded.
You don't need to type command. Just move in the server :D


## WARNING
This plugin will convert your worlds immediately after you joined, so make sure that this plugin is disabled when publishing your server


## How to use
Put your map of java edition to your world folder. Open your server with this plugin, and join your server. You will see the converted blocks and signs.


## Settings
`enable-async-mode` - If you set to true, blocks conversion will be run asynchronously to reduce lag

`enable-output-progress` - If you set to true, the progress of conversion will be printed on console.

`enable-convert-sign` - If you set to true, texts in json format written in sign will be converted

`convert-sign-java` - If you set to true, sign text in raw text (not json) will be converted to json text

`remove-all-entities` - If you set to true, entities in chunks are removed

`export-all-logs` - If you set to true, conversion logs will be exported to plugin folder when server stopped