from langchain_groq import ChatGroq
from langchain_community.agent_toolkits import create_sql_agent

class Agent:
    """Responsável por consultar o modelo de linguagem."""

    def __init__(self, db, model_name, api_key):
        self.model = ChatGroq(
            temperature=0,
            model=model_name,
            api_key=api_key
        )
        self.executor = create_sql_agent(
            self.model,
            db=db,
            agent_type="openai-tools",
            verbose=False,
            agent_executor_kwargs={
                "prefix": (
                    "Você é um assistente que responde perguntas sobre um banco SQLite. "
                    "A principal tabela se chama 'data'. Use apenas essa tabela. "
                    "Filtre por 'ano_da_emenda' sempre que o usuário mencionar um ano. "
                    "Use os nomes de colunas exatamente como estão: 'localidade_de_aplicacao_do_recurso', 'valor', 'ano_da_emenda', etc."
                )
            }
        )

    def answer(self, question):
        result = self.executor.invoke(question)
        return result.get("output", "")
