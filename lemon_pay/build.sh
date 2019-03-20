docker build --tag=39.108.191.89:5000/lemon_pay_api . || exit $?
docker push 39.108.191.89:5000/lemon_pay_api  || exit $?

