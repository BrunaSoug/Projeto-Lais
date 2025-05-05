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
            agent_type="zero-shot-react-description",
            handle_parsing_errors=True,
            verbose=False,
            agent_executor_kwargs={
                "prefix": (
                    "Você é um assistente que responde perguntas sobre emendas parlamentares usando um banco SQL. "
                )
            }
        )

    def answer(self, question):
        result = self.executor.invoke(question)
        return result.get("output", "")
