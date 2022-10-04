<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/validator.js')}}"></script>
<script>
    Validator({
        form: '#validator_signup',
        formGroupSelector: '.form-group',
        errorSelector: '.form__message',
        rules: [
            Validator.isRequired('#new-username',
                '<i class="fas fa-exclamation-triangle warn_icon"></i>Vui lòng nhập vào tên đăng nhập của bạn'
            ),
            Validator.isPassword('#new-password',
                '<i class="fas fa-exclamation-triangle warn_icon"></i>Mật khẩu không chính xác'),
            Validator.isEmail('#new-email',
                '<i class="fas fa-exclamation-triangle warn_icon"></i>Email không chính xác'),
            Validator.isConfirmed('#new-repassword', function() {
                return document.querySelector('#validator_signup #new-password').value;
            }),
        ]
    });
    Validator({
        form: '#validator_signin',
        formGroupSelector: '.form-group',
        errorSelector: '.form__message',
        rules: [
            Validator.isRequired('#username',
                '<i class="fas fa-exclamation-triangle warn_icon"></i>Vui lòng nhập vào tên đăng nhập của bạn'
            ),
            Validator.isPassword('#password',
                '<i class="fas fa-exclamation-triangle warn_icon"></i>Mật khẩu không chính xác'),
        ]
    });
</script>


</body>

</html>
