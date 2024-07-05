document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('artworkModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const modalUser = document.getElementById('modalUser');
    const span = document.getElementsByClassName('close')[0];
    const commentText = document.getElementById('commentText');
    const commentsDiv = document.getElementById('comments');

    document.querySelectorAll('.artwork-item').forEach(item => {
        item.addEventListener('click', function () {
            const artworkId = this.getAttribute('data-id');
            modalImage.src = this.getAttribute('data-file');
            modalTitle.innerText = this.getAttribute('data-title');
            modalDescription.innerText = this.getAttribute('data-description');
            modalUser.innerText = 'Uploaded by: ' + this.getAttribute('data-user');

            
            modal.setAttribute('data-id', artworkId);

            // Fetch comments via AJAX
            fetch('get_comments.php?artwork_id=' + artworkId)
                .then(response => response.json())
                .then(data => {
                    commentsDiv.innerHTML = '';
                    data.forEach(comment => {
                        const p = document.createElement('p');
                        p.innerText = comment.username + ' (' + comment.created_at + '): ' + comment.comment;
                        commentsDiv.appendChild(p);
                    });
                })
                .catch(error => console.error('Error fetching comments:', error));

            modal.style.display = 'block';
        });
    });

    span.onclick = function () {
        modal.style.display = 'none';
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    document.getElementById('submitComment').addEventListener('click', function () {
        const comment = commentText.value;
        const artworkId = modal.getAttribute('data-id');

        if (comment.trim() === '') {
            alert('Comment cannot be empty');
            return;
        }

        fetch('submit_comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ artwork_id: artworkId, comment: comment })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const p = document.createElement('p');
                p.innerText = data.username + ' (' + data.created_at + '): ' + comment;
                commentsDiv.appendChild(p);
                commentText.value = '';
            } else {
                alert('Failed to submit comment: ' + data.error);
            }
        })
        .catch(error => console.error('Error submitting comment:', error));
    });
});
