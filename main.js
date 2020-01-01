document.addEventListener("DOMContentLoaded", async () => {
    const addStudentBtn = document.getElementsByClassName("addStudentBtn")[0];
    const studentName = document.getElementsByName("studentName")[0];
    const studentGroup = document.getElementsByName("studentGroup")[0];


    const studentTable = document.getElementById("studentTable");

    const json = await fetch("/getAllStudents")
    const res = await json.json();
    let studentData = "" //ох как это будет медленно, лучше бы через массив сделал
    for (let i=0; i< res.length; i++) {
        studentData += "<tr>" + "<td>" + res[i].name + "</td>" + "<td>" + res[i].group + "</td>" + "</tr>";
    }

    console.log(studentData)
    studentTable.insertAdjacentHTML("beforeend", studentData);


    addStudentBtn.addEventListener("click", async () => {
        //TODO validate

        const options = {
            method:"post",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "name": studentName.value,
                "group": studentGroup.value
            })
        };
        let response = await fetch("/addStudent", options);
    })

});