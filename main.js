document.addEventListener("DOMContentLoaded", () => {
    const addStudentBtn = document.getElementsByClassName("addStudentBtn")[0];
    const studentName = document.getElementsByName("studentName");
    const studentGroup = document.getElementsByName("studentGroup");
    
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