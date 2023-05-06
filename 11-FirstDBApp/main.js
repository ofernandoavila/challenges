var db = new Customer('database');

function StartOnLoadPage() {
    db.initialLoad([
        { userid: '1', name: 'Fernando', email: 'fernandoavilajunior@gmail.com' },
        { userid: '2', name: 'Woody', email: 'woody_ocao@gmail.com' },
        { userid: '4', name: 'Jack', email: 'jack_ocao@gmail.com' }
    ]);
}

function LoadDB() {
    AddLogMessage('DB loaded!');
    AddNotification('The database was loaded!', 'success');
}

function FetchDB() {
    AddLogMessage('DB fetch!');
    AddNotification('The database was fetched!', 'warning');
}

function ClearDB() {
    AddLogMessage('DB fetch!');
    AddNotification('The database was fetched!', 'warning');
}