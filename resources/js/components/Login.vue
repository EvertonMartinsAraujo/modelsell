<template>
    <div class="login">
               
      <div class="login-container" >
        <img src="/images/Logo.png" alt="ModelSell" class="logo" />
        <div class="logo-h3">
          <h3>Modelsell</h3>
        </div>
          <h1>Seu catalogo de vendas</h1>

            <div class="login-box">
                <h2>Login</h2>
                <form method="POST" @submit.prevent="login($event)">
                    <input type="email" v-model="email" placeholder="E-mail" required />
                    <input type="password" v-model="password" placeholder="Senha" required />

                        <div class="remember-me">
                            <input type="checkbox" id="remember" />
                            <label for="remember">Lembrar de mim</label>
                        </div>
                    <button type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            email: '',
            password: '' }
    },

    methods: {
        async login() {
            try{
                const autenticacao = await axios.post('http://localhost:8000/auth/login', {
                    email: this.email,
                    password: this.password,
                }, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                // Salvar o token no localStorage
                const token = autenticacao.data.access_token;
                localStorage.setItem('token', token);

                // Define o token para todas as próximas requisições
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                
                //Rota para prox pagina
                this.$router.push('/catalogo')
        
            } catch(erro){
                if(erro.response.status === 401){
                    alert('Email ou senha incorreto. Verifique os dados tente novamente.');
                }else{
                    alert('Erro ao logar, verifique o log');
                    console.log(erro);
                }   
            }
        }
    }
}
</script>

<style>
#app {
  background-color: white;
  color:black;
}

.login {
  background-color: white;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  
}

.login-container {
  width: 100%;
  max-width: 600px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;


}

.logo {
  width: 150px;
  margin-bottom: 4%;
}

.logo-h3 {
  font-weight: bold;
  color: #0056b3;
  font-size: x-large;
}
.login-box {
  width: 100%;
  padding: 30px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-color: #f9f9f9;
}

.login-box h2 {
  text-align: center;
  color:black;
}

.login-box input {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.login-box button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  }

.login-box form {
  display: flex;
  flex-direction: column;
  align-items: center; 
}

.login-box button:hover {
  background-color: #0056b3;
}

.remember-me {
  display: flex;
  align-items: center;           /* Alinha checkbox e texto na mesma linha */
  justify-content: flex-start;   /* Cola à esquerda do container */
  font-size: 14px;
  color: black;
  gap: 8px;                      /* Espaço entre o checkbox e o texto */
}

</style>


