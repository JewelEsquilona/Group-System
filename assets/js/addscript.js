function updateDepartments() {
    const college = document.getElementById('College').value;
    const departmentSelect = document.getElementById('Department');
    const sectionSelect = document.getElementById('Section');

    departmentSelect.innerHTML = '<option value="">Select Department</option>';
    sectionSelect.innerHTML = '<option value="">Select Section</option>';

    let departments = [];
    if (college === 'CITCS') {
        departments = ['BSCS', 'BSIT', 'ACT'];
    } else if (college === 'CAS') {
        departments = ['MASCOM', 'PSYCH'];
    }

    departments.forEach(department => {
        departmentSelect.innerHTML += `<option value="${department}">${department}</option>`;
    });

    document.getElementById('DepartmentContainer').style.display = college ? 'block' : 'none';
    sectionSelect.parentElement.style.display = college ? 'block' : 'none';
}

function updateSections() {
    const department = document.getElementById('Department').value;
    const sectionSelect = document.getElementById('Section');
    sectionSelect.innerHTML = '<option value="">Select Section</option>';
    let sections = [];

    if (department === 'BSCS') {
        sections = ['CS4A', 'CS4B', 'CS4C', 'CS4D'];
    } else if (department === 'BSIT') {
        sections = ['IT4A', 'IT4B', 'IT4C', 'IT4D'];
    } else if (department === 'ACT') {
        sections = ['ACT4A', 'ACT4B', 'ACT4C', 'ACT4D'];
    } else if (department === 'MASCOM') {
        sections = ['MC4A', 'MC4B', 'MC4C', 'MC4D'];
    } else if (department === 'PSYCH') {
        sections = ['PS4A', 'PS4B', 'PS4C', 'PS4D'];
    }

    sections.forEach(section => {
        sectionSelect.innerHTML += `<option value="${section}">${section}</option>`;
    });
}

function updateEmploymentStatus() {
    const employment = document.getElementById('Employment').value;
    const employmentFields = [
        'EmploymentStatusContainer', 'PresentOccupationContainer',
        'EmployerNameContainer', 'EmployerAddressContainer',
        'YearsInEmployerContainer', 'TypeOfEmployerContainer',
        'MajorLineOfBusinessContainer'
    ];

    employmentFields.forEach(id => {
        const field = document.getElementById(id);
        if (field) {
            field.style.display = (employment === 'Employed') ? 'block' : 'none';
        }
    });
}

function toggleEmploymentFields() {
    const employment = document.getElementById('Employment').value;
    const employmentFields = [
        'EmploymentStatusContainer', 'PresentOccupationContainer',
        'EmployerNameContainer', 'EmployerAddressContainer',
        'YearsInEmployerContainer', 'TypeOfEmployerContainer',
        'MajorLineOfBusinessContainer'
    ];

    employmentFields.forEach(id => {
        const field = document.getElementById(id);
        if (field) {
            field.style.display = (employment === 'Employed' || employment === 'Self-Employed') ? 'block' : 'none';
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Ensure elements exist before calling functions
    if (document.getElementById('College')) {
        updateDepartments();
    }
    if (document.getElementById('Department')) {
        updateSections();
    }
    if (document.getElementById('Employment')) {
        toggleEmploymentFields();
    }

    // Add event listeners
    const collegeSelect = document.getElementById('College');
    const departmentSelect = document.getElementById('Department');
    const employmentSelect = document.getElementById('Employment');

    if (collegeSelect) {
        collegeSelect.addEventListener('change', updateDepartments);
    }
    if (departmentSelect) {
        departmentSelect.addEventListener('change', updateSections);
    }
    if (employmentSelect) {
        employmentSelect.addEventListener('change', toggleEmploymentFields);
    }
});

