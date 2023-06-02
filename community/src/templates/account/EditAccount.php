<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/header') ?>
<style>
    .loading-circle {
        position: relative;
        width: 50%;
        height: 50%;
        border-radius: 50%;
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    async function ChangeProfilePicture(userHash) {
        let label = document.querySelector('.profile-image-label');
        let input = document.querySelector('input[name="profileImage"]');
        let file = input.files[0];

        const formData = new FormData();
        formData.append('profileImage', file);
        formData.append('userHash', userHash);

        label.innerHTML = `<div class="loading-circle"></div>`;
        label.classList.remove('hidden');

        await fetch('<?= $data['config']['base_url'] ?>/update-profile-picture', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                let img = document.querySelector('img#profile-image');
                img.setAttribute('src', data.url);
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
            })
            .finally(() => {
                label.innerHTML = `<i style="color: #fff; font-size: 26px;" class="fa-solid fa-pencil"></i>`;
                label.classList.add('hidden');
            });
    }
</script>
<div class="row justify-center align-items-center">
    <div class="row">
        <div class="column flex flex-1">
            <fieldset>
                <?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/account_side_menu') ?>
            </fieldset>
        </div>
        <div class="column flex flex-3">
            <fieldset>
                <div class="text-header">
                    <h2>Edit Account</h2>
                </div>
                <div class="row">
                    <div class="input-group flex-column">
                        <input style="display: none;" onchange="ChangeProfilePicture('<?= $data['user']->userHash; ?>')" type="file" name="profileImage" id="profileImage">
                        <label for="profileImage">
                            <div class="profile-image">
                                <img id="profile-image" src="<?= $data['config']['storage_url'] . $data['user']->GetProfilePicture(); ?>" alt="">
                                <div class="profile-image-label hidden"><i style="color: #fff; font-size: 26px;" class="fa-solid fa-pencil"></i></div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <form class="w-50" action="<?= $data['config']['base_url'] ?>/my-account/edit-account" method="post">
                        <div class="row">
                            <div class="input-group">
                                <input type="text" name="name" id="name" placeholder=" " value="<?= $data['user']->name ?? ''; ?>">
                                <label for="name">Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group">
                                <input type="text" name="username" id="username" placeholder=" " value="<?= $data['user']->username ?? ''; ?>">
                                <label for="username">Username</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">
                                <input type="text" name="email" id="email" placeholder=" " value="<?= $data['user']->email ?? ''; ?>">
                                <label for="email">Email</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group">
                                <input type="submit" value="Save changes" class="btn btn-normal">
                            </div>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<?php ofernandoavila\Community\Core\Template::LoadTemplatePart('common/footer') ?>