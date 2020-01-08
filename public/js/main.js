document.addEventListener("DOMContentLoaded", async () => {
    const addCountryBtn = document.getElementsByClassName("addCountryBtn")[0];
    const countryName = document.getElementsByName("countryName")[0];
    const countryCapitalName = document.getElementsByName("countryCapitalName")[0];
    const countryTable = document.getElementById("countryTable");


    const json = await fetch("/getAllCountries")
    const res = await json.json();
    console.log(res);
    let countryData = ""; //ох как это будет медленно, надо на массив переделать
    for (let i=0; i< res.length; i++) {
        countryData += tr(td(res[i].name) +
            td(res[i].capitalName) +
            td("<button class='deleteCountryBtn'>Delete country</button>"))
    }

    countryTable.insertAdjacentHTML("beforeend", countryData);


    const deleteCountryBtn = document.getElementsByClassName("deleteCountryBtn"); //array
    for (let i=0; i<deleteCountryBtn.length; i++) {
        deleteCountryBtn[i].addEventListener("click", async () => {
            let countryId = res[i].id;
            await deleteCountry(countryId);
            //window.location.replace("/"); // не оч
        })
    }

    addCountryBtn.addEventListener("click", async () => {
        const errorSpan = document.getElementById("serverError")
        if ( !countryName.value.match(/[A-Za-zА-Яа-я]{2,40}/)) {
            showError(errorSpan, "Не правильное название страны")
        }
        else if(!countryCapitalName.value.match(/.+/)) {
            showError(errorSpan, "Не правильная название столицы")
        }
        else {
            hideError(errorSpan);
            await addCountry(countryName.value, countryCapitalName.value)
            //window.location.replace("/"); // не оч
        }

    })

});

function showError(element, errorString) {
    element.innerHTML = errorString;
    element.className = 'error'
}

function hideError(element) {
    element.innerHTML = "";
    element.className = 'clear'
}

function wrap(htmlWrapper, wrappedObject) {
    const closeTag = htmlWrapper.slice(0,1) + "/" + htmlWrapper.slice(1, htmlWrapper.length);
    return htmlWrapper + wrappedObject + closeTag;
}

function td(wrappedObject) {
    return wrap("<td>", wrappedObject)
}

function tr(wrappedObject) {
    return wrap("<tr>", wrappedObject)
}

async function post(url, params) {
    const options = {
        method:"post",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(
            params
        )
    };
    const response = await fetch(url, options);
    return response;
}

async function addCountry(name, capital) {
    return await post("/addCountry", {"name":name, "capitalName": capital});
}

async function deleteCountry(countryId) {
    return await post("/deleteCountry", {"id": countryId});
}