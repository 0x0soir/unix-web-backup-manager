    <?php if ( ! isset($NOT_INCLUDES)): ?>
                    </main>
                </div>
            </div>
        </body>
    <?php endif ?>
    <script src="/assets/js/jquery-3.2.1.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- scripts -->
    <script src="/assets/js/particles.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

<?php if (isset($user) && $user == TRUE) { ?>
    <script src="/assets/js/user/user.js"></script>
<?php } ?>
</html>
