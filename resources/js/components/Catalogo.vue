  <template>
    <div class="produtos-page">
          <!-- Cabeçalho, pesquisa e logout -->
      <header class="cabecalho">
        <div class="nome-usuario">
          Olá, {{ user.name }}<br>
        </div>
        
        <div class="cabecalho-search">
          <input v-model="termoBusca" type="text" placeholder="Pesquisar produtos..."/>
        </div>
       
        <div>
          <button style="align-items: end;" @click="logout" class="button">Deslogar</button>
        </div>
      </header>
      <!--adicionar-->
      <div style="width: 100%; text-align: center; margin-top: 40px;" v-if="user && user.role === 'admin'">
        <button @click="adicionarProd">Adicionar Produto</button>
      </div>
       <!--catalogo de produtos-->    
      <div class="produto-container" v-for="produto in produtosFiltrados" :key="produto.id"><br>
        <div>
          <img :src="`http://localhost:8000/storage/${produto.imagem}`" v-if="produto.imagem" class="produto-imagem"/>
        </div>
        <div style="text-align: center;">
          {{ produto.nome }}<br>
          {{ produto.descricao }}<br>
          R$ {{ produto.preco }}  
          <!--faz nada kk-->
          <button @click="comprar(produto)">Comprar</button>
          
          <!--so aparece para adm -->
          <div v-if="user && user.role === 'admin'">
            <button @click="editar(produto)">Editar</button>
            <button @click="deletar(produto.id)">Excluir</button>
          </div>
          
          <!--modal para adição ou edição-->
          <div v-if="produtoForm" class="modal-overlay">
          <div class="modal-content">
            <h2 style="text-align: center;">{{ modoEdicao ? 'Editar Produto' : 'Adicionar Produto' }}</h2>
            <label class="modal-desc">Nome:  </label>
              <input class="modal-search" type="text" v-model="produtoForm.nome"><br>
            <label class="modal-desc">Descrição:  </label>
              <input class="modal-search" type="text" v-model="produtoForm.descricao"><br>
            <label class="modal-desc">Preço:  </label>
              <input class="modal-search" type="number" v-model="produtoForm.preco"><br>
            <label class="modal-desc">Imagem:  </label>
              <input class="modal-search" type="file" @change="handleImagemChange"><br>
            <button @click="salvarProduto">{{ modoEdicao ? 'Salvar Alterações' : 'Cadastrar Produto' }}</button>
            <button @click="cancelarFormulario">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

  <script>
  import axios from 'axios'

  export default {

    data() {
      return {
        produtos: [],
        produtoForm :null,
        imagemSelecionada: null,
        user: {},
        termoBusca: '',
        modoEdicao: false,
      }
    },

    computed: {
      produtosFiltrados() {//le e retorna o conteudo da pesquisa
        const termo = this.termoBusca.toLowerCase();

        return this.produtos.filter(produto => {
          return (
            produto.nome.toLowerCase().includes(termo) ||
            produto.descricao.toLowerCase().includes(termo) ||
            produto.preco.toString().includes(termo)
          );
        });
      }
    },

    async mounted() {//para token 
      const token = localStorage.getItem('token')
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
     //para produtos
      const prodRes = await axios.get('http://localhost:8000/api/produto')
      this.produtos = prodRes.data
      //para verificar quem esta logado
      const userRes = await axios.post('http://localhost:8000/api/auth/me')
      this.user = userRes.data
    },

    methods: {//excluir
      async deletar(id) {
        await axios.delete(`http://localhost:8000/api/produto/${id}`)
        this.produtos = this.produtos.filter(p => p.id !== id)
      },

      adicionarProd() {//adicionar produto
        this.produtoForm = {
          nome: '',
          descricao: '',
          preco: '',
        };
        this.imagemSelecionada = null;
        this.modoEdicao = false;
      },

      editar(produto) {//editar
        this.produtoForm = { ...produto };
        this.imagemSelecionada = null;
        this.modoEdicao = true;
      },

      cancelarFormulario() {//cancelar
        this.produtoForm = null;
        this.imagemSelecionada = null;
        this.modoEdicao = false;
      },

      handleImagemChange(event) {//para alteraçao de imagem
        this.imagemSelecionada = event.target.files[0];
      },

      async salvarProduto() {//salva
        const form = new FormData();
        form.append('nome', this.produtoForm.nome);
        form.append('descricao', this.produtoForm.descricao);
        form.append('preco', this.produtoForm.preco);
        if (this.imagemSelecionada) {
          form.append('imagem', this.imagemSelecionada);
        };

        try {
          if (this.modoEdicao) {
            
            form.append('_method', 'PUT');
            await axios.post(`http://localhost:8000/api/produto/${this.produtoForm.id}`, form, {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            });
            alert('Produto atualizado com sucesso!');
          
          } else {
            await axios.post(`http://localhost:8000/api/produto`, form, {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            });
            alert('Produto cadastrado com sucesso!');
          
          }

          this.cancelarFormulario();
          
        } catch (error) {
          console.error('Erro ao salvar produto:', error);
          alert('Erro ao salvar produto.');
        
        }
      },

      comprar(produto){//Implementar se necessario
        alert (`Voce comprou o produto: ${produto.nome}, manda o pix`);  
      },

      logout() {
      // Remover token do localStorage, autorizacao e voltar pra pagina inicial
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
        this.$router.push('/');
      }
    }
  }
  </script>


  <style>

  body {
    background-color: white;
    color: black;
    margin: 0;
    font-family: Arial, sans-serif;
  }

  .cabecalho {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #acbac8;
    color: black;
    padding: 10px 20px;
    width: 100%;
  }
.cabecalho-search{
  background: white;
  color: black;
  border: 1px solid #ccc;;
}
  .nome-usuario {
    font-weight: bold;
    align-items: flex-start;
  }

  .produto-container {
    background-color: #1a1a1a;
    color: white;
    padding: 15px;
    border-radius: 8px;
    width: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .produto-imagem {
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin-bottom: 10px;
    border: 1px solid #444;
  }

  .produtos-page {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
    background-color: #000; /* fundo preto */
    color: #fff;
  }

  button {
    background-color: #fff;
    color: #000;
    border: none;
    padding: 6px 12px;
    margin: 5px;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    transform: scale(1);
    transition: transform 0.2s ease-in-out;
  }


  button:hover {
    background-color: #ccc;
    transform: scale(1.1); /* Aumenta 10% ao passar o mouse */
  }

 
  .modal-overlay {  
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background-color: rgba(51, 50, 50, 0.3);
    display: flex; justify-content: center; align-items: center;
    z-index: 1000;
  }

  .modal-content {
    color: black;
    background: rgb(179, 178, 178);
    text-align: left;
    padding: 40px;
    border-radius: 8px;
    min-width: 300px;
  }

  .modal-desc {
    display: flex;
    justify-content: space-between;
    width: 100px; 
    align-items: left;
    margin-right: 10px;
  }
  
  .modal-search {
    flex: 1;
    padding: 8px;
    margin: 8px 0;
    background-color: white;
    border: 1px solid #ccc;
  }
  </style>