function select (element) {return document.querySelector(element)}
function selectAll (element) {return document.querySelectorAll(element)}
function iframe (src, sizes) {
    return `<iframe src="${src}" style="width: ${sizes}; height: ${sizes};" frameborder="0">`
}
function adminApp() {
    const apps = {
        addStudent: ['addStudent', 'Ajouter Étudiant', iframe('_admin/icons/addStudent.svg', '80%')],
        listStudents: ['listStudents', 'Liste Étudiants', iframe('_admin/icons/listStudents.svg', '80%')],
        viewerStudent: ['viewerStudent', 'Viewer Étudiant', iframe('_admin/icons/viewerStudent.svg', '80%')],
        schedule: ['schedule', 'Horaire', iframe('_admin/icons/schedule.svg', '80%')],
        selectedProfessors: ['selectedProfessors', 'Professeurs Alignés', iframe('_admin/icons/selectedProfessors.svg', '80%')],
        viewerProfessors: ['viewerProfessors', 'Viewer Professeur', iframe('_admin/icons/viewerProfessors.svg', '80%')],
        trash: ['trash', 'Corbeille', iframe('_admin/icons/trash.svg', '80%')],
        sittings: ['sittings', 'Paramètres', iframe('_admin/icons/sittings.svg', '80%')]
    }; return apps
}
function fillAppBoxes (arr) {
    ih_app_box.forEach(element => {
            select(`.${element.className.split('app ').join('')} ._icon`).style.scale = '0'
            select(`.${element.className.split('app ').join('')} ._appname`).style.opacity = '0'
        setTimeout(() => {
            select(`.${element.className.split('app ').join('')} ._icon`).innerHTML = ''
            select(`.${element.className.split('app ').join('')} ._appname`).innerHTML = ''
        }, 400);
    });
    setTimeout(() => {
        for (const index in ih_app_box) {
            if (Array.isArray(arr[index])) {
                setTimeout(() => {
                    select(`.${ih_app_box[index].className.split('app ').join('')} ._icon`).style.scale = '1'
                    select(`.${ih_app_box[index].className.split('app ').join('')} ._appname`).style.opacity = '1'
                    select(`.${ih_app_box[index].className.split('app ').join('')} ._icon`).innerHTML = arr[index][2]
                    select(`.${ih_app_box[index].className.split('app ').join('')} ._appname`).innerHTML = arr[index][1]
                    ih_app_box[index].setAttribute('id', arr[index][0])
                }, (50 * Number(index)));
            }
        }
    }, 500);
}
const   index_log_out_btn = select('.index .mn-box.right-side'),
        index_username = select('.index .mn-box.right-side ._username'),
        index_user_popup = select('.index ._user-popup'),
        index_log_out_popup = select('.index ._log-out-popup'),
        index_log_out_popup_cancel = select('.index ._log-out-popup .cancel')
        
index_log_out_btn.addEventListener('click', () => {
    index_username.classList.toggle('orangered')
    index_user_popup.classList.toggle('appear')
    index_log_out_popup.classList.toggle('appear')
})
index_user_popup.addEventListener('click', () => {
    index_log_out_popup.classList.add('show')
})
index_log_out_popup_cancel.addEventListener('click', () => {
    index_log_out_popup.classList.remove('show')
    setTimeout(() => {
        index_username.classList.remove('orangered')
        index_user_popup.classList.remove('appear')
        index_log_out_popup.classList.remove('appear')
    }, 250);
})
// ADMIN PART
// filter Apps
const   ih_filter_slider = select('.index section .home menu ._slider'),
        ih_fltbys = selectAll('.index section .home menu ._fltby'),
        ih_app_box = selectAll('.index section .home menu .low-side .apps .app'),

        adm_all_apps = [
            adminApp().addStudent, 
            adminApp().listStudents, 
            adminApp().viewerStudent, 
            adminApp().schedule, 
            adminApp().selectedProfessors, 
            adminApp().viewerProfessors, 
            adminApp().trash, 
            adminApp().sittings, 
            '',
            '',
            '',
            ''
        ],
        adm_professors_apps = [   
            adminApp().schedule, 
            adminApp().selectedProfessors, 
            adminApp().viewerProfessors, 
            adminApp().trash, 
            adminApp().sittings, 
            '',
            '',
            '',
            '',
            '',
            '',
            '',
        ], 
        adm_students_apps = [
            adminApp().addStudent, 
            adminApp().listStudents, 
            adminApp().viewerStudent, 
            adminApp().schedule, 
            adminApp().trash, 
            adminApp().sittings, 
            '',
            '',
            '',
            '',
            '',
            ''
        ]

fillAppBoxes(adm_all_apps)
ih_fltbys.forEach(index => {
    index.addEventListener('click', () => {
        switch (index) {
            case ih_fltbys[0]: 
                ih_filter_slider.style.transform = 'translateX(0)';
                fillAppBoxes(adm_all_apps)
            break;
            case 
                ih_fltbys[1]: ih_filter_slider.style.transform = 'translateX(100%)';
                fillAppBoxes(adm_professors_apps)
            break;
            case ih_fltbys[2]: 
                ih_filter_slider.style.transform = 'translateX(200%)';
                fillAppBoxes(adm_students_apps)
            break;
        }
    })
});
