    <?php if ( ! isset($NOT_INCLUDES)): ?>
                    </main>
                </div>
            </div>
        </body>
    <?php endif ?>
    <script src="/assets/js/jquery-3.2.1.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap-datetimepicker.min.js"></script>
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

    <?php if (isset($js_scripts) && $js_scripts == TRUE) { ?>
        <script src="/assets/js/backups/scripts.js"></script>
    <?php } ?>

    <?php if (isset($js_charts) && $js_charts == TRUE) { ?>
        <script src="/assets/js/charts/echarts.common.min.js"></script>
    <?php } ?>

    <script type="text/javascript">
        $(function () {
            $(".form_datetime").datetimepicker({
                format: "dd/mm/yyyy hh:ii",
                autoclose: true,
                todayBtn: true,
                startDate: "2013-02-14 10:00",
                minuteStep: 10
            });
        });
    </script>
</html>
