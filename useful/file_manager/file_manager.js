/**
 * @description Get a file and return callback with file data
 * @param {string} path Path to the file
 * @param {*} callback Callback function
 */
async function GetFileContentAsString(path, callback) {
    if (path == undefined || path == null || path == "")
        throw new Error("Path cannot be null!");

    await fetch(path)
        .then((response) => {
            if (!response.ok)
                throw new Error("Cannot get the file with the path given");

            return response.arrayBuffer();
        })
        .then((buffer) => {
            var conteudo = new TextDecoder().decode(buffer);
    		callback(conteudo);
        })
        .catch((error) => {
            console.error("An error ocurred: ", error);
        });
}
