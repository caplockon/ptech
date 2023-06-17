export function showModal(callback) {
    callback();
    if (document.getElementsByClassName('modal-backdrop-element').length > 0) {
        return;
    }

    const backdrop = document.createElement('div');
    'modal-backdrop-element bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40'.split(' ').map((className) => {
        backdrop.classList.add(className);
    });
    document.body.append(backdrop);
}

export function hideModal(callback) {
    const backdrop = document.getElementsByClassName('modal-backdrop-element');
    if (backdrop.length > 0 && document.querySelectorAll('.modal-backdrop:not(.hidden)').length <= 1) {
        for (let i = 0; i < backdrop.length; i++) {
            backdrop[i].remove();
        }
    }

    callback();
}

export function getStateClasses(show) {
    return show
        ? 'justify-center items-center flex'
        : 'hidden';
}