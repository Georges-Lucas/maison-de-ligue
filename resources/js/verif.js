document.addEventListener('DOMContentLoaded', function() {
    const mdp = document.getElementById('mdp');
    const mdp_c = document.getElementById('mdp_c');

    function checkPasswordMatch() {
        if (mdp.value !== mdp_c.value && mdp_c.value.length > 0) {
            mdp_c.style.borderColor = 'red';
        } else {
            mdp_c.style.borderColor = '';
        }
    }

    mdp.addEventListener('input', checkPasswordMatch);
    mdp_c.addEventListener('input', checkPasswordMatch);
});