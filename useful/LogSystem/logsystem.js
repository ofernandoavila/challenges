/**
 * @description Add log message into log container
 * @param {string} message Log message to be added into log container
 * @returns {void}
 */
function AddLogMessage(message) {
    if(document.querySelector('.log-container pre') == undefined) throw new Error("Log container not foud!");
    if (document.querySelector('p.empty-log') != undefined) document.querySelector('p.empty-log').remove();
    
    let finalMessage = "[" + DateToString() + "] " + message;

    if(logContainer.querySelectorAll('p').length > 0) {
        logContainer.insertBefore(createElement('p', [
            { key: 'content', value: finalMessage}
        ]), logContainer.querySelector('p:first-of-type'));
    } else {
        logContainer.appendChild(createElement('p', [
            { key: 'content', value: finalMessage}
        ]));
    }    
}

const logContainer = document.querySelector('.log-container pre');

if(logContainer.innerHTML.trim() == "") {
    logContainer.appendChild(createElement('p', [
        { key: 'content', value: "Empty log"},
        { key: 'class', value: ['empty-log']}
    ]));
}

