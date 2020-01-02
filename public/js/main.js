document.addEventListener("DOMContentLoaded", async () => {
    const addStudentBtn = document.getElementsByClassName("addStudentBtn")[0];
    const studentName = document.getElementsByName("studentName")[0];
    const studentGroup = document.getElementsByName("studentGroup")[0];
    const studentTable = document.getElementById("studentTable");


    const json = await fetch("/getAllStudents")
    const res = await json.json();
    console.log(res);
    let studentData = ""; //ох как это будет медленно, надо на массив переделать
    for (let i=0; i< res.length; i++) {
        studentData += tr(td(res[i].name) +
            td(res[i].group) +
            td("<button class='deleteStudentBtn'>Delete student</button>"))
    }

    studentTable.insertAdjacentHTML("beforeend", studentData);


    const deleteStudentBtn = document.getElementsByClassName("deleteStudentBtn"); //array
    for (let i=0; i<deleteStudentBtn.length; i++) {
        deleteStudentBtn[i].addEventListener("click", async () => {
            let studentId = res[i].id;
            await deleteStudent(studentId);
            window.location.replace("/"); // не оч
        })
    }

    addStudentBtn.addEventListener("click", async () => {
        const errorSpan = document.getElementById("serverError")
        if ( !studentName.value.match(/[A-Za-zА-Яа-я]{2,40}/)) {
            showError(errorSpan, "Не правильное имя")
        }
        else if(!studentGroup.value.match(/.+/)) {
            showError(errorSpan, "Не правильная группа")
        }
        else {
            hideError(errorSpan);

            await addStudent(studentName.value, studentGroup.value)
            window.location.replace("/"); // не оч
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

async function addStudent(name, group) {
    return await post("/addStudent", {"name":name, "group": group});
}

async function deleteStudent(studentId) {
    return await post("/deleteStudent", {"id": studentId});
}