window.scrollTo(0,document.body.scrollHeight);

/*
u('form').handle('submit', async e => {
    log('Sending... ');
    const form = u(e.target);
    try {
        await fetch(form.attr('action'), {
            method: form.attr('method'),
            body: form.serialize()
        });
        log("Awesome! (:");
    } catch (error) {
        log("Error: " + error);
    }
});
*/