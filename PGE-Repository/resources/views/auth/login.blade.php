<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PEMA Global Energi Docs</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(to bottom right, #f8f9ff, #ffeef0);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            width: 380px;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .login-container img {
            width: 130px;
            margin-bottom: 1.5rem;
        }

        h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 1.5rem;
        }

        .form-group {
            text-align: left;
            margin-bottom: 1rem;
        }

        label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
            display: block;
            margin-bottom: 0.3rem;
        }

        input {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.95rem;
            outline: none;
            transition: border 0.2s ease;
        }

        input:focus {
            border-color: #1e3a8a;
        }

        .btn-login {
            width: 100%;
            background: #0b2948;
            color: white;
            border: none;
            padding: 0.7rem 0;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-login:hover {
            background: #153b6b;
        }

        .links {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #374151;
        }

        .links a {
            color: #0b2948;
            font-weight: 500;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        footer {
            position: fixed;
            bottom: 10px;
            left: 20px;
            font-size: 0.8rem;
            color: #6b7280;
        }

        footer a {
            text-decoration: none;
            color: #6366f1;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXIAAACICAMAAADNhJDwAAABv1BMVEX///8zLCsuJiUdEhAiGBbLyck9RZ9aVVS0s7I6QpQwKSgxOW4yOnIoHx7aIyn4+PgZDAmOi4vHJSq5JyozO3XQJCrf3t7eIinVIymzKCrDJio7Q5i+JiqwKCopIR80PHvjISlwbGzv7u6al5fU09N/e3tDPDteWlmnKSs2PoOXLCv78fK7urmgKiuULCuqKSuMLSsAAAA3P4iELitSTUx7Lyx0cHCNLSt0MCwSAAD3xcfjAA3y8vgpM43Yvbzk5e7mu7zRvbzZ2ugoMoWlqMj0urzGyN0yO5i6vNaHg4MsNpqUmMehn56YcG7iAAAjLotGTZBIT5wlLm12e7HMBhJYXp6zDRImMZy+wNxHTnpFTKJ6f6s1Pp/TAA9jabGcEhS0AABmCgB+GRSiCQ5uHBZkap+NkbcdKHp0eaRDSYcVInOrrswmMHmYm8NtcqoOHoZfZJB0eJ0WImaSla+oq76doctqb5A4QHLxjI9qb7XtfYDoX2ToPEIAAXWvstX529zuo6UADF/VQ0fSZmnIPUHXhojETU+sjIrYm5yJFxTScXOGU0+rhILIrq2GSUa/X2DXWV6lWFe8fX2nR0erOjuVkoj+AAAdMklEQVR4nO2djVsTx9bAN8kCIRo3gKAYjCaExJrY60ekje42NMSErzYESKwiSlWwLR9WsW9b27f0tWrBW9tr2z/4nTkzuzu7O5tkk8Uq3vM8PsJudrP8cnLmfM2MILQpUq64trW4Up197/z587PVlfnVtYm83O5d/yt8kfJrq9X1e+Pr64g2Jg4yPj6ujM8uFv7L3W2RJ774cn19/T0q543S3T2unN9cy/3TT7l/RH608pWOm4OcYi9X1/ZC1y8RSe3Brd9QKT4w4rZBjqEjZZ8vuv3+qcsgn15x+8Zvqjz6cv29EyfskY+zgqB3K5U1d58gdRLk8ruBXNpaXz+BhYccIZ6tzq8WJopEJjYWN6uVcUUpK9+4aV/eJeRS4QQBbkF+fvze7BeFfE6yXCPnihub3feVgvVUq/IOIZ/4UgVuRI54r6xxaOsi5QuV0oRbz/HOIM9f04GzyNff+6LYjAbLa/N5d54EIT+CZL8jl7YenjjBQX7PiRuYc8eivxvI81/OnbAiX//qC5cU15GkgPg+R7711YnDFuTr64v/THSZAuJHlvYx8tzX64etyO/V1XD3/BOr7H/k+RNzhy3I1780A5fzxYnC6hcr1eoskSqkFYvufxMQ8kNI9i/yRw9PHDYjX3/PLqCUc/liYbF6flzBkec4ioMUpVrIu6r0KSBuRC55It7XLdmYm3+VLlsPDx82I7/3RSPVlXITi7NliPdxyF/uXnQx08JHHnjtskfIH8wdtiC/96ipS6X8RkWjXlIqrsWfqUMc5GLI97rl3F4gl76mxBnk6186sM75xW4VelhRNlzyyznIhY5/QPbAR9CJ68jXHzi7h7zRrXSrql5yRdMR8qNI9uXwqRPXkH9VcHwXeaMcVqErFRdsegqI70vkX88dNCNfb4mYPK9Q6OFwebNt67J/kT+YO2hB3mp8X6woFHm4FP6szQdLHd2nyLcQcRPyudYzKvJ8mSIPh6cW23syHvJYV5KR6MiMPrbFolhGWRkZGRmdwed6olSSafXlPeqduobZN43RgwPtPXs9efTwoBn5XFuB5Bo2LoA8XKq0lQ1DyPstyI2RUCTo80Xj9FQWnYuYxTeCz0VFeoEYVe/kU+8hjrBv2kOOB6PCXkke67gJeZtZw3wlTJGHO6faMS4YOZIFA/JAwGOSSLaHnPKZz8DZSXwu6qW/BrzUyY6HjK9Q7++l9xfjbTx5PZEPHjQhP7Hedp5WrpbCqkxNt36fVH+/HfIACVJEQtIHzPnIg0bkHh+1LD1BLnLtcMSg+y7KNQvyh25E7JuKzvz7ll10e+QBTxxLhz9JCGWxSqrII0FWQsSwaMgjo+RGiQAPuaTpvse3N9Z8a86M/GFzQX4jmdeZlyqtDg31kKu/+0VNJSly0T9gEDAkOnKPCCowIHp4yImSR/ZOzfMqcQ35nMOYUxAm+O73vGZbOks3WjRVzSAXMhhmICFoyH08I8wg93XgAzNc5MSSR0aAeWgPUivStwcPGJGf+Nr5TarcOFWqaMRb9s+bQg544PcmkRPLkvTykA9jJfdGBTAvwT1Qc2RWTMhbcQ+l2ar1Kvn7kuqzTLcchTav5d6MoBuWjphB4FUM8oAXWZaYruQMcnJz9DWYBDUPuq7meeSRG5E/bKkFRe4eN1+Xq1DiU+145gh5L5KFMeYY35YHscvC91i64GWAPDISJJ8Jvcw7GjAiHxapkRoIaXd1VbC3YkDu3JATyXWXVw0HPqPAS+Gf2nnAeshjeGSM+5NEW0PYu9CQs+UFL4NcTCcCdFykvwcNyCW4mehXXx+IuKzmj+YOGJGfONyqCSgqChPbo5ifAC/rNiU3/43z26Z6e22QewIhLKpfHoKgnqvlLHJfBzgkgYREfEGRXKEhB0seEPGPHb49UHP5wAET8jb8ww1FmVd/XusuQcBf3tRtyjedpSnnFqYOckYCkewMOeWzKnkgYkAeh5f44kDUGyXkVeQS3JpiJm676GpxYmvOhLwFb0WXajfRc7lAChUl5aaOuHh9qrOzs+L48esh13Ms3iiNWSjyQIIVTxLOUeSEZHAYhkcxbUQ+TOwKMSZ+YvYNGa82RX5o1vKH7SSzcuPdSkEuLioEeHlTj2Fzm1c7sTgP/esh7wJJjvZ0aPa2oZOIkBPLkiEvjEmsYYl5yJ0zRIj98rqo5ljJDchbHTupbODSJxQowooyrWu4PF0qdRJxbFrskTNOInOqCeRx0OQAtfIGW64GRwH4+qjJrRmHz2wvOUzciLwdJUf6rZaau40TWGQVeGdnqeLwrgj5MSRuImdSK8FhA3IpaElRkqHW4UPbypYZ+dxWC3eRcQPR2upm5f79slJWKtXFNUvz0E9TGvMphy7jXiAf1hKI6HUscqLkAT3R7nVXzbG7YkLuXMkR7om1Apa1tYliPidzfUypoiHvvO7MC00B8RaQSwbB5zTkA1lGfxnkEr3viFZRIgEr951akUdzJuRtWvJ68hmj5s5G0BQQP1YbY441Rm5K3gah8UdDThIEHhIQMciJkvv8zP1IGsZwqA25ZtbyttyVBsKo+ZSjt2kRuUmyWM115OooicN+HbnkIbdlzSIJh1xS8/xDE/LD7fjkjOSKHK+kqKv5DUdqjpAPIXEXuZoo90kscvJBmAw3DYdcUfMHB0zIXSkFCZuKUuZ5JayaO7HmXOQRXG+OeDkvj4X4TZyAHJebQ1CD6wpCORlHpbEsLUhLQbirx5hTSYfglW44LfJBE/LD37riCm2gOEjhdEcz1vyGk1RLamjIipw2R3BeHvMkeALRTE8ymkx2QXHCn9SaK6QREL+QhmNRs3dC+zBcKDwX50zIW/IQrZJHyMOz1uPydcZpcfDh8pDXE4kvzb/h3sn/HDAjd2nyFY6Gypyc+7QeD005MGFOkb+5EjtgQn74W5fuvIqi/nDVejzPWJZ562k72T/INbuiInfNKS/ipFaZ85WptGRZEPI+JPsA+ZZZy+fcmmwi4X7EMKcT8Rvdslxt3oilgLgRuZTseu2SaLs49K0Z+UPXRpgqpG6tt2Nd8+YTLak+DnI1U/4ape25QrmHJuSHr7V5R11WIYVr/dLIV3Xk3zd9Ny7yoE983dL2XKFHcybkLrmIWCawMQ9zRkjGTZxq+m485IL/H5B2rcCDA2bk7s0bzENzebclxPxMJ955tekAlIv8bZRvzchdTGnJMG+lbPoMpekpBnnznjlCPojkrUWuLsMmz5mRH3QvPpNmMfPShuFg8Xqpk9XypvuTUkD87UX+Hf0/b0buVhYRZAWqn2w0pFabNSX/3oFhebuR/0jV/JEZuavViXliWfSWIb3aTPwVJ8W41ODbjfzkz+T/LQty9xwWQZiGpgrVTczNG4EjFXcybtRDHksPR7syiUxy0m9K9HWksdjeNJbuiaLruqLDaaPvF/OnDdIR5/qGac7t4/iQ1a85eZKo+f9YkLvTxE+kQPpYcIpWLm5O4d5EBvh1Z23PCPlxJFbkkr8rKwYjXtxzGBFDnmEWTjIkij5ePh0uzKALvV58XdCXjXYw5+LnjN64z5f1jlo+ujS86lyH4eBwluu9n7z8GP7PXTP55e6UJ6iAY94d3hSK05Up0gyq2ZQb3zgcp+2Q+xM+6NLEArUy0ctkunEBCFr8rZKmF+I+FXyl18fMNYxbi0qBiC9j+g6R0intdFQF2gasMwBOnvz0EvnpgTGt5VbmFqSozrRV9FkUFLjWE9o0+NRxkDtjhqPSqA/hCgRFL+5/i4jQ0u/T2+/tkU+GoD1O9GSSyUQALvTq1WSCPKJrOTS2eEMGhU7TuUTGo7bITx4xj6AEuZuV5ryiTigPs8inrmvLhOambzZ7My5yKYP/vkigJw4fXaxjNAh1TY25LfJR6P2MTBK9lTpGRcw0pH5BAHkwTWcYxePpngTpxGVRqp1HMIdAE3vkSz+of/a1OefIc0VeLZkROVcszIetyEtXb2oTinLzN6aaTrJwkcMcuGAX8/cNJDDzkGp27ZBPAvEEM8+tA/Q4Sy8E5IbZntJk0FSDTvvAnqmla1VskP+I19V8rP6G56yofnnTWi4XF1cW14qWhiwpV5xY3ax0K4q6akK3znuqU+9QzH8/dcNBkYKHfAaDiSSN7487IgLqiGmDvCMLxA3PPoBbDwMBwsqKXJCwUquzFrFgSx7pwG9nsOZ1kJ+8rAZEQv7anGPkcF1hZfx/782uLK6urm6sri7Or8x2l8uKoi6AwyIvlaYq0/rgXLx59Uank8YKhPxfSFjkMRaSJumsGBI9VFttkMO4Z56yDPNXRNJRboc8qM/ewkoeGSGEWTW3Qf6ErB+r6bn0aG6OBPxObbmcLyyev18uq6tow/rlRuDd4ZJSLm2yy5v9dHPqBnEVmw6GUkDcgBz6TSyTG6RhfzymvhUfObTcsgpLBPc001ZPDvKZoHGkxB9bdkCQRJOa2yD/AZAfWfpBoyBvzcEiFS0Nn3JxDa8fpy1erik3XkquFK5OTxgMv4xcRudprX9ZkIOu1p93zEcOVMQO7uEQcLYgj4/Ad0Dv36BKTpv/mY/CBvljgvzI0o/b2rHc1sG5tjwW3Hi7gYzLSpXI5ub8dKGY50xK1BPmzbeZI+SnkDDIJWjiDNa9io8cjpoNEm2CI/1YgDyQoWuDZBKhUAT7K8zkT2xmRPxxS5GAwWmxQf7dZYL8yMmln/Wj8qNr/+eOk1i/YURuKV9uQQ6TAwPa3zpgWHSM6j4feYZv4YlnOKz9SBv69Z5+5nuBfXI6/RbUXLfmNsh/VpEjRX+yzZx4LZvUMJ39DqpCQPzUrTHtCKzooVvRkSyztF6W6iMXuUSMtuUtLMj1BV0I9ITuIuJPTSSfa8zotNggv6IjR4r+3d7tYiLJcs7yxclpRYobTUdCHOQmLSeTkKmos6wcaTkxLIAVkHtHJ6mMRDM4Pg34uui3Fyy56r3AwKquM2KHfJtBfuTQUv/eLFi1igx6JXzfMkLqJX4HzbepU2bkxJZH1F9VLRcbI49CeG+hAl4iQUeGT3ZkHhgF/4iOn/ChJdX1ogJsCGqDPPUpi/wQGkb3ALo0WwojD7FssVU/3dDsioOmCgtyEnBrHkuc5ln9gYbIwfpaPRYyyxlgcZxEMoGOxLVpo6k3ZFpskEsnDcjxKps/XnHbvMjEVbT2yOldiU5ah06dOoPk1kf6IfjjLH45LIJQHzm0lXvNDbsDWPcj5CgPuUSm/uMf8YfNrtylrUki2CInsRCL/CgyL8/chU4q/KbaJ5abel2o+dGag3wAMk0Bk2MOGlgfOZmGYlbz0YjuefCQCzBM4o8EuyuR5IguJEIg1twO+eMlM3IkCwu/bFte2bqsKbwKP9L+VkZPhPyMGTkxEN6M4c+TEo0NixDHw0AgaPiwIGGj2moe8o6gemNEOGDo+IcPn1pzO+TgJZqRH0Wq/uRn11R9ddymj6WV0ZOLXOgCW+Bh0AxkIo2HT8QFvJ2gXueResDlVOcHWYfP2AykGrHFxt8jkz2b1J0WO+TbXOT9/f1HF/pfXGoeRD2p0JqQWeY1U+6ov/wMB3mMZrGj/gHEShqg+XIjco9n2CA92A2E7G3Al0zjC2MDMwn4wni0sRicxBHtkpGkh0wgwokZyK6YaqW6mgPySI/xPYfpxkg85EDdFVWXwZQrlkaVIlN0dhDrcpELUtIHHppIFlMB5xlroxG5cSKiCFHLcAhWKCJ1JBHnpgKi3lVLq0LaNSQWQh+RQJV8UjCK7s6Q+bumyY84LfHEHjleTmnpl7ZVnVQ+Sya7UqwwzVoOTLkNcuRMe3xkGiypFnhFjx9ZcyNyo3hJgr0j44swFwZEL2MrOLVPb9BHok88WPjMhgOmoIMJ06dMs4JOfLdUD3lvb//C0zZVHWpCRrsi/6TnEJElv+poepYNckHyJ0M+MYhctaDoy2ZmYkJPiC6IiFyTbMgiWTVoSUfFkHZhYoalGD9nviiSmUyDofejU+csiV9hGF9xzo/03XwpCHrFpcv1keNFIfrbUnVLR2J+upOxKTembjrqJrBFLuDSpX94cmSkZ4Z0o8SGZ2bowDjAFf3CuOFC5o6mK2J6mg5+52Tt1FvHbN+yMXIky09bDpBoeV/9NVeAvgoVeMkhcEB+GgkX+VsiPzSB/Nix3uWhndagk4Z+iIPk/Ea1xPaxlK4636xvHyC/crkZ5HjWfK8xKm2u80QGF7FUzE9sVE19LFOl6Ray8ikg/lYjTzWLfOhYrcZqupSfWJvIyw3IU7uilHXctMh/c6KlfurU6bceObIsTSLHsy37DJlGKV9YmV1Z3JjI53MW9rAUzkTVXOEnvK9vtNoORpHvvs3Ir1xuHjmC/tyUfpGLq+e/un9v/Px5vDFcdWUFap6zs3hbeEVRus3IO0slpolFKDpdp3I/IE8dOekAed/Q8o7lFrniavX8vfFxuhe8neCFKcPfFzTecnF+ytEqFfC4byByCS+j68RMPl7SkD9eOtQA+VBfX+05z3fJFQuLs/cQ9266P7yJtqKUw5vfFDXCUnH++tQNJ9kVIgj5+0gMyGd6eELKOpPws5FHDB2kXYhCepJ7sfoyVmb8nO7ymH8kmfB4vZ5MdNiYcYSn4q/bsn1Zqwo9vgLM6yPvG6rZqRgaUgvzs924j0VhJVydLxg2osS8S4bJ+80qSQqIG5F3iUGrhACbP4t/9hmjxIFzwWCWwhgOca4NBuBlWdNRUQwkjcn1gWhQxC3tOF3gDYoJtvUcP5XPZsOQJydVLV/avrRwqCHyvj6OcWEFD5zF4sTa2trERBGvaWY4K+WnSzTe19fGkT6ue0ddeMiTnAwKTauSRZ7pxhSq4AK1um4QNxVCFjBiF9dWT3izUV3TpZEsSc94aenfG0rGDE9lKTlRufSpivzID8J2/6HGyPtq9ZnXE9yjFbY0DP3atJa/b4Pca9qqMAsZLYrcE2K/4RbkAdF4bQgakQhy/ZRIFjDXukZj0GLtFX2Z6Gg0EYI26aCehayHnKo53WAw9WShIfLBwdaZz2sTV5gi86/NKrktcm8ybtqqEPIZKnJDuc2MPJAwb3MIVhmQe9PaQf8IQA/SFt9YAhbJzZAslxCbgaR9JGN4KjvkxE8Ej2UBDY2/LDVGPrg81ghODpkW63TOwpQafZZ0Q/7y341upglC/gESK3JrUg8LWQYevvx6FsuKnPsdA+SGVfmlUaZVBYj72DWHJ5me3QbIiZoT5LgL9+elxsgHa43qoyvlsnUZlqKWYynpWfKPP29+DYIUEOcg5/9xGHmkhzTua1xbRk6byyEjTDoyjCWKEbb4Vh/5pcuaX76EE7XbC0fNyId6Tcj7jtfPc+WRv2ghnuvUcyzaoBr//GXdOxmkBeS+uD/EGIR2kEOtA2obsSCnuy6GvZrscMOnwoKjftpUcRSTTP1nwYh8eftFzYh88M4L29thqSpVS5gjhzXkJe3jiH/evFlpDXmH0AMqqTbMtoE8o06hIEpudrtRNKD57g2Qb3+qRZ9HyOShn7Gi68nbp8jE14zIB23dcyyF+/OWv0NWNwAJMxXm+MXPnWxJlfrgg7NInNhy3JMSBSNM2zdbR07mSuBLu7weU0eFWRogF75b0gL+pWdwZBspuoa8ho89rxmRDz63v1/xvnVtRGabuKsa8Y/v3v21znNbxA55IDHJ9PCMqCxU5AI7Xcvql7OXjqq+Den3Yud8jZLBWKKTZUwzPU3SCHnqRz3Hom7seKX/qIp8AUpxmDmDnDPFWJUiZ0OynK7jJZ345xedmBWM/CwXObvkdSTisyCPYb8lQBbVtiJnr1XjUoI8oO0jmhFDZFZonN6C2b6Ms2tRQ+RoBNXTWgvUGUm9IIp+rHcIhsoUYs4it1XzImdn7Ly6dRZL/OXdix86WzGJIr9dN/oMBC3IhTge77wQqdSPPkU1aiehkNfQzx/wJfQZLVrfUExkNxdJ6k9VF7nweInp1lKdEWJdjvX+Qn6VntdY5MdtHEWZU+35TDMqJX3k/O3uh583HQQRSZ21Qe5l59pnrcjJJGSIVDjRJ7tqlkHL9b1a4JcMXQgB5hFoXSwxH7trUdPIBTAtJHl7tFdzAMf+s9DLLF39S41F3vesWVIbZW1X25uqI5P6990PnRlyAZBfQGJBjv443gKrDHK929A6fMZ41xLDQlfJzZB9WdRkITEsKtBYKKJ/Exwg317S8+VHn+hON4K+rP/2osYgP36nOU65TYWWKDqntA7cgQ/vXrz7SXM30CUFxLnIecIiF0ZodOjEY0HDJ/kgYjDLUHXEySwVNbiPqV390P3cPHIUdDI9iQxzYZtV5mfLLPKmWnTXSmFaFSqFWTN+8eLvzvcVagO5kIQY3d+ak+j3MX4mMWZBs3ub9DpDjjxFvSrE2BaT7NQY5E1kt3LVMq1TlPQmc+mT24i4w6ETS1vIJXAVfXhSTwt+Ofii6u9+3vxemPDlCLnww4JeiDvaa6fB28eHVOSDfzS6pbyqzuEPl+e1YfXji1jH77awLW/qQhvIhYFIgKa5WkAOk6GDNOQiuyaYWs/hFc6QI++cKcQt2PXFpf6oUeTH/25gGeheZUjDy0yb0G9YxS/ebWXZ9faQ070kWkNOu8fp3dIwHcAwuYt8iZwhF1L9bCGOnX9rlDFszzHywXq5LblAS/wlpbKhO44fX7jbMvF2kROLbEHONXAW5JKXTWXBYBwQ9eWzOjxk9SFnyIXtQ2whbuEXO6KpP5bJgkv242d+kczkV8qV6aKuRrFPbl8A4g4dcvWNbZB7Epa1l/EpC3Khx2dB7vFkTNdmIGC15FjAtde25YuSLRQTPen4QLxjuMtHNwd0iByY61Who8dskY713cHjp01qK7cxq5Ci82bBkML9FQ9/Leu4jpz9wEj0aVl7GX/MVuQkw2VCHjBdG+IjJy6PdmgySzINog8vAeWF5vQWkOPiJ1OI61+wjXZSz2qD5jWusEhycbX7/v3xSnVzw7wm0csLtzGwixcutrqhPR85d1cVfMqPQnETcqErgs6q62cNi7xr6dY36Ccj8oEgPqRxxNMB9F3kvL5Ex2REQ96FnirSFHJsz9lC3MJTW0X/6Pkdo5coyfmJwuri6saapa4Pr//9NgF24feWl6JOgVW6aEQesd3Ihoc8lkAwxJaQoy8FOhbSeyc6RhIhspJ3SEwisz5wzhfK6E/VJHKm4Ew3enyhh/9jxpfumMrO9Vam+OjV7bNURf/d+oq6MQ7yeruq8LZXYcP6RtdaFrAyH5RiHX7/jD9NVlLDq1R22LyyrqgFZ5ov71/eoZe+WDb1JKaabFRLvTy7S4FfuP1bs8/BuxEQb3XwfYOFFpz1EsVTAv3p0NDyC+fzcLd/++D2WZX4WQeVTqvE9ity4RK4iky5GaCncL58qPZ8zMmtUi9f7d7GCVei4r+3OnAS2b/IScGZbao4Vlt+tkNLFLXBZqexIN63dknt7GzbRgXLPkaOC87mPpaaVojrq9X+2GlkYFLbO692d6EiT5Hfvtg2qX2NXC84c1uH+u7c+fvZmB321Ec7r97f3T1NeqsI8rO77aq4sN+RC8KV3gVb5Lj22XenVnv+587YdgpEQv+2Pxrb+fOvW7du7ZJGcB357qv2rDiR/Y4cRZhQ+7RBTmTw1h0kt/AKEqfQjwg2mSdIiKvId1+5M+8BIf8Qyf5FjqzLi4X+usjxQpGnqJyhctqMfPf9tjxDRmJAfF8jx9D7a00hP3OGj/z93b/cAv6OIMe1TwS9VeSn3TIpRGIfvhPIkU3f6Vsm1J0hP7176083Bk1d3hnkAlb1p8s1R8hP7yIFd3vL3ncJuSBIY0C9OeS7t3b/fLkHy4u+W8ixbO88X0ZBaF9d5Lu37pz+86O9Wc6VInfaV/eWy/bOi+eDtdodpO0mJ/FfKAQ689ernT3CjUX6hIgLm7K/ZZLaHtt59uKPv4/jALQGodDff72CQPSffrT9LpKUosH+m7G3/Zsu/w+3ZbJUu344mQAAAABJRU5ErkJggg=="
            alt="PEMA Global Energi Logo">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <form action="/login" method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </form>
        <div class="links">
            <p><a href="#">Forgot Password?</a></p>
            <p>Don't have an account? <a href="/register">Register now.</a></p>
        </div>
    </div>

    <footer>
        {{-- Made with 💜 <a href="#">Vercel</a> --}}
    </footer>

</body>

</html>
