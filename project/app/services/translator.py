from translate import Translator as TranslatorLib

class Translator:
    """Traduz textos para o português."""

    def __init__(self, target_language="pt"):
        self.translator = TranslatorLib(to_lang=target_language)

    def translate(self, text):
        return self.translator.translate(text)
