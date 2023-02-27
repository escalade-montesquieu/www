const forumEl = document.getElementById('forumMessagesList');

if (forumEl) {
    const forumOlderMessageLoadingIndicator = document.getElementById('forumOlderMessageLoadingIndicator');
    const nMessageNeededToScrollBottom = 5;
    const scrollTopNeededToLoadOlderMessages = 50;
    let loadingOldMessages = false;
    let scrollBottomBeforeLoadOlderMessages;

    window.addEventListener('DOMContentLoaded', () => {
        scrollForumMessagesListToBottom();
    });

    window.addEventListener('forum.message.sent', () => {
        scrollForumMessagesListToBottom();
    })

    window.addEventListener('forum.message.older-loaded', () => {
        forumEl.scrollTop = forumEl.scrollHeight - scrollBottomBeforeLoadOlderMessages;
    })

    forumEl.addEventListener('scroll', function () {
        if (forumEl.scrollTop < scrollTopNeededToLoadOlderMessages) {
            loadOldMessages();
        } else {
            loadingOldMessages = false;
            forumOlderMessageLoadingIndicator.classList.toggle('hidden', true);
        }
    })

    function loadOldMessages() {
        if (loadingOldMessages) {
            return;
        }

        loadingOldMessages = true
        forumOlderMessageLoadingIndicator.classList.toggle('hidden', false);
        scrollBottomBeforeLoadOlderMessages = forumEl.scrollHeight - forumEl.scrollTop


        Livewire.emit('forum.message.load-older')
    }

    function scrollForumMessagesListToBottom() {
        forumEl.scrollTop = forumEl.scrollHeight;
    }

    window.addEventListener('forum.message.new', () => {
        const allMessages = Array.from(forumEl.querySelectorAll('.message'));

        console.log('new message');

        if (allMessages.length < nMessageNeededToScrollBottom) {
            return;
        }

        const forumElScrollBottom = forumEl.scrollTop + forumEl.clientHeight;
        const thirdLastMessage = allMessages[allMessages.length - nMessageNeededToScrollBottom];

        if (forumElScrollBottom < thirdLastMessage.offsetTop) {
            return
        }

        forumEl.scrollTop = forumEl.scrollHeight;
    })
}
