<h1>🚩 CSV2JSON 🚩</h1>

**Tier: 1** I'm getting confortable with the challenge idea

In the [JSON2CSV](../17-JSON2CSV/README.md) application you translated JSON 
to a comma separated value (CSV) format. The objective of CSV2JSON is to 
reverse that process by converting a block of CSV text to JSON.

In CSV2JSON you'll start by copying the JSON2CSV app you created and then
modify it to allow CSV to JSON conversion as well the JSON to CSV conversion
that's already present. In additional to providing a useful function, this
challenge will also give you practice in modifying existing applications to
add new functionality.

### Constraints ###

- Read the user stories below carefully. Some of the functionality created
for JSON2CSV will need to be modified.
- You may not use any libraries or packages designed to perform this type of
conversion.
- Nested JSON structures are not supported.

## User Stories

-   [x] User can paste CSV syntax into a text box
-   [x] User can click a 'Convert to JSON' button to validate the CSV text box and convert it to JSON
-   [x] User can see an warning message if the CSV text box is empty or if it doesn't contain valid CSV
-   [x] User can see the converted CSV in the JSON text box

## Bonus features

-   [ ] User can enter the path to the CSV file on the local file system in a text box
-   [ ] User can click a 'Open CSV' button to load file containing the CSV into the text box
-   [ ] User can see a warning message if the CSV file is not found
-   [ ] User can click a 'Save CSV' button to save the CSV file to the file entered in the same text box used for opening the CSV file
-   [ ] User can see a warning message if the CSV text box is empty or if the save operation failed.
-   [ ] User can enter the path to the JSON file on the local file system in a text box
-   [ ] User can click a 'Open JSON' button to load file containing the JSON into the text box
-   [ ] User can see a warning message if the JSON file is not found
-   [ ] User can click a 'Save JSON' button to save the JSON file to the  file entered in the same text box used for opening the JSON file
-   [ ] User can see a warning message if the JSON text box is empty or if the save operation failed.

## Example projects

- [CSV to JSON](http://ofernandoavila.avilamidia.com/challenges/8-CSV2JSON/)