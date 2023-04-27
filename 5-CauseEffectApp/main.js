const peoples = [
	{
		name: "Fernando",
		street: "Rua México 41",
		city: "Rio de Janeiro",
		state: "RJ",
		country: "Brazil",
		telephone: "+55 (21) 3245-3234",
		birthday: "12/08/1999",
	},
	{
		name: "John",
		street: "International Drive 6500",
		city: "Orlando",
		state: "FL",
		country: "USA",
		telephone: "+1 (321) 234-3869",
		birthday: "12/08/1999",
	},
	{
		name: "Peter",
		street: "Morning View Drive Malibu 30460",
		city: "Malibu",
		state: "CA",
		country: "USA",
		telephone: "+1 (321) 234-3869",
		birthday: "12/08/1999",
	},
	{
		name: "Frank",
		street: "Mountain View 21",
		city: "Palo Alto",
		state: "CA",
		country: "USA",
		telephone: "+1 (321) 234-3869",
		birthday: "12/08/1999",
	},
	{
		name: "Bill",
		street: "500 Yale Ave N",
		city: "Seattle",
		state: "WA",
		country: "USA",
		telephone: "+1 888-446-2099",
		birthday: "12/08/1999",
	},
];

function renderData(id, element) {
    if (document.querySelector(".item-selected") != null) {
		document.querySelector(".item-selected").classList.remove("item-selected");
    }
    
    element.classList.add("item-selected");
    document.querySelector("h4.name").innerHTML = peoples[id].name;
    document.querySelector("span.birthday").innerHTML = peoples[id].birthday;
    document.querySelector("span.street").innerHTML = peoples[id].street;
    document.querySelector("span.city").innerHTML = peoples[id].city;
    document.querySelector("span.state").innerHTML = peoples[id].state;
    document.querySelector("span.country").innerHTML = peoples[id].country;
    document.querySelector("span.telephone").innerHTML = peoples[id].telephone;
}

function renderList() {
    let list = document.querySelector('.item-list');
    peoples.forEach( (people, key) => {
        let item = document.createElement('li');
        item.setAttribute('onclick', 'renderData(' + key + ', this)');
        item.innerHTML = people.name;
        list.appendChild(item);
    });
}

renderList();