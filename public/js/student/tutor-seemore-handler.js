bodyUI.addEventListener('click', e => {
    if (e.target.classList.contains('seemore-btn')) {
        const templateId = e.target.dataset.template;
        const mode = e.target.dataset.mode;

        document.location.href = `../student/tutor-profile?template_id=${templateId}&mode=${mode}`;
    }
})