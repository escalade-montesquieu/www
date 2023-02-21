<section wire:poll id="forumMessagesList"
         class="relative h-full flex-shrink-1 overflow-y-auto flex flex-coool gap-8 py-16 lg:-mx-4 lg:px-4">
    @forelse($messages as $message)
        <x-forum.message :message="$message"/>
    @empty
        <span>Pas de message pour l'instant</span>
    @endforelse

    <script>
        const forumEl = document.getElementById('forumMessagesList');
        const nMessageNeededToScrollBottom = 5;

        window.addEventListener('DOMContentLoaded', () => {
            scrollForumMessagesListToBottom();
        });

        window.addEventListener('forum.message.sent', () => {
            scrollForumMessagesListToBottom();
        })

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
    </script>
</section>


