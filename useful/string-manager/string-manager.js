/**
 * @description Function that returns a string searched between two intervals
 * @param {string} text The content that you want to search in
 * @param {string} delimiterInitial The initial string delimiter
 * @param {string} delimiterFinal The final string delimiter
 * @returns {string} The search result
 */
function GetContentBetweenDelimiters(
    text,
    delimiterInitial,
    delimiterFinal
) {
    var initialPosition = text.indexOf(delimiterInitial);
    
    if (initialPosition === -1) {
        return null;
    }
    
    var finalPosition = text.indexOf(
        delimiterFinal,
        initialPosition + delimiterInitial.length
    );

    if (finalPosition === -1) {
        return null;
    }
    
    return text.substring(
        initialPosition + delimiterInitial.length,
        finalPosition
    );
}

/**
 * @description Returns a string without content given by the user
 * @param {string} a main text
 * @param {string} b to be remove
 * @returns string
 */
function RemoveFromString(a, b) {
    return a.replace(b, "");
}

/**
 * @description Get the first word by string
 * @param {string} a text that you want the first word
 * @returns string
 */
function GetStringFirstWord(a) {
    var words = a.split(" ");
    return words[0];
}
