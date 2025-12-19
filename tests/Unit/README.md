# Testes Unitários - Performance e Segurança

Este diretório contém testes unitários focados em **performance** e **segurança** para componentes críticos da aplicação.

## 📊 Estrutura dos Testes

### Enums (`tests/Unit/Enum/`)

#### ✅ PaymentMethodEnumTest
**Arquivo:** `AccountsReceivable/PaymentMethodEnumTest.php`

**Aspectos de Segurança Testados:**
- ✓ Validação de valores string sem caracteres perigosos (XSS)
- ✓ Unicidade de valores (previne duplicação)
- ✓ Sanitização de labels (sem HTML/JS malicioso)
- ✓ Validação de cores e ícones Filament
- ✓ Proteção contra valores inválidos (ValueError)
- ✓ Segurança em `tryFrom()` com inputs maliciosos

**Aspectos de Performance Testados:**
- ✓ `getLabel()` - 10k iterações < 100ms
- ✓ `getColor()` - 10k iterações < 100ms
- ✓ `getIcon()` - 10k iterações < 100ms
- ✓ Criação de enum - 100k iterações < 50ms

---

#### ✅ PaymentStatusEnumTest
**Arquivo:** `AccountsReceivable/PaymentStatusEnumTest.php`

**Aspectos de Segurança Testados:**
- ✓ Validação de valores inteiros >= 0
- ✓ Unicidade de valores
- ✓ Sequência correta de valores (importante para database)
- ✓ Sanitização de labels contra XSS
- ✓ Validação de cores reflete criticidade do status
- ✓ Proteção contra valores negativos/inválidos
- ✓ Segurança para uso em banco de dados (valores < 256)

**Aspectos de Performance Testados:**
- ✓ `getLabel()` - 10k iterações < 100ms
- ✓ `getColor()` - 10k iterações < 100ms
- ✓ `getIcon()` - 10k iterações < 100ms
- ✓ Criação de enum - 100k iterações < 50ms

---

#### ✅ SignatarioTypeTest
**Arquivo:** `DigitalSignature/SignatarioTypeTest.php`

**Aspectos de Segurança Testados:**
- ✓ Valores seguem padrão lowercase/snake_case
- ✓ Sem caracteres especiais perigosos
- ✓ Labels e descriptions protegidos contra XSS
- ✓ Método `options()` não vulnerável a mass assignment
- ✓ Proteção contra SQL injection nos valores
- ✓ Validação de inputs maliciosos em `tryFrom()`

**Aspectos de Performance Testados:**
- ✓ `getLabel()` - 10k iterações < 100ms
- ✓ `getDescription()` - 10k iterações < 100ms
- ✓ `options()` - 1k iterações < 50ms
- ✓ Múltiplas chamadas a `options()` - 10k iterações < 500ms
- ✓ Criação de enum - 100k iterações < 50ms

---

### Console Commands (`tests/Unit/Console/Commands/`)

#### ✅ SendTrialNotificationsTest
**Arquivo:** `SendTrialNotificationsTest.php`

**Aspectos de Segurança Testados:**
- ✓ Parâmetros `--days` aceita apenas inteiros válidos
- ✓ Modo `--dry-run` não envia notificações reais
- ✓ Logs não expõem dados sensíveis (senhas, tokens)
- ✓ Parâmetros negativos não causam problemas
- ✓ Parâmetros muito grandes são limitados
- ✓ Exceções são tratadas graciosamente
- ✓ Filtragem de datas é precisa e segura
- ✓ Proteção contra timing attacks (básico)

**Aspectos de Performance Testados:**
- ✓ Processa 100 usuários < 2 segundos
- ✓ 500 usuários não vaza memória (< 50MB)
- ✓ Usa eager loading (evita N+1 queries)
- ✓ Dataset vazio finaliza < 500ms
- ✓ Parâmetros grandes não degradam performance (< 5s)

---

#### ✅ GenerateDailyBlogPostTest
**Arquivo:** `GenerateDailyBlogPostTest.php`

**Aspectos de Segurança Testados:**
- ✓ Parâmetro `--topic` sanitizado contra XSS/injection
- ✓ `--category` e `--author` aceitam apenas IDs válidos
- ✓ Tópicos do array não contêm código malicioso
- ✓ Tópicos não contêm SQL injection patterns
- ✓ Logs não expõem informações sensíveis
- ✓ Categoria/autor inexistente tratado graciosamente
- ✓ Opção `--publish` é validada como booleana

**Aspectos de Performance Testados:**
- ✓ Array de ~200 tópicos < 100KB de memória
- ✓ Seleção de tópico - 1000 iterações < 100ms
- ✓ Similar_text com 30 posts < 2 segundos
- ✓ Comando não vaza memória (5 execuções < 20MB)
- ✓ Filtro de posts recentes usa query eficiente

---

## 🎯 Métricas de Performance

### Enums
| Operação | Iterações | Tempo Máximo | Status |
|----------|-----------|--------------|--------|
| getLabel() | 10,000 | 100ms | ✅ |
| getColor() | 10,000 | 100ms | ✅ |
| getIcon() | 10,000 | 100ms | ✅ |
| from()/tryFrom() | 100,000 | 50ms | ✅ |

### Console Commands
| Operação | Volume | Tempo/Memória Máximo | Status |
|----------|--------|----------------------|--------|
| Processar usuários | 100 | 2s | ✅ |
| Processar usuários | 500 | 50MB memória | ✅ |
| Dataset vazio | - | 500ms | ✅ |
| Seleção de tópico | 1,000 | 100ms | ✅ |
| Verificação similaridade | 30 posts | 2s | ✅ |

---

## 🛡️ Checklist de Segurança

### ✅ Proteção contra XSS
- Todos os enums validados
- Labels/descriptions sanitizados
- Inputs de comandos validados

### ✅ Proteção contra SQL Injection
- Valores de enum validados
- Tópicos verificados
- Parâmetros de comandos sanitizados

### ✅ Proteção de Dados Sensíveis
- Logs não expõem senhas
- Logs não expõem tokens
- Dry-run não envia notificações reais

### ✅ Validação de Inputs
- Parâmetros de comandos tipados
- Valores de enum com ValueError
- tryFrom() retorna null para inválidos

### ✅ Rate Limiting & Memory
- Commands não vazam memória
- Eager loading previne N+1
- Queries otimizadas com filtros

---

## 🚀 Como Executar os Testes

### Todos os testes unitários
```bash
php artisan test --testsuite=Unit
```

### Testes de Enum específicos
```bash
php artisan test tests/Unit/Enum/
```

### Testes de Console específicos
```bash
php artisan test tests/Unit/Console/
```

### Com cobertura de código
```bash
php artisan test --coverage --testsuite=Unit
```

### Teste específico
```bash
php artisan test tests/Unit/Enum/AccountsReceivable/PaymentMethodEnumTest.php
```

---

## 📈 Relatórios de Performance

Para gerar relatórios detalhados de performance:

```bash
# Com profiling
php artisan test --profile --testsuite=Unit

# Com timer detalhado
vendor/bin/phpunit --testsuite=Unit --testdox
```

---

## 🔧 Manutenção dos Testes

### Ao adicionar novo Enum:
1. Criar arquivo de teste correspondente
2. Copiar estrutura de teste existente
3. Adaptar validações específicas
4. Garantir cobertura de segurança e performance

### Ao adicionar novo Command:
1. Criar arquivo de teste em `Console/Commands/`
2. Mockar dependências externas
3. Testar com diferentes volumes de dados
4. Validar sanitização de inputs
5. Verificar não vazamento de memória

---

## 📝 Convenções

### Nomenclatura de Testes
- `it_` para testes de comportamento
- `method_name_` para testes de método específico
- Descrições claras e em português

### Organização
- Um arquivo de teste por classe
- Métodos agrupados por categoria (segurança/performance)
- Comentários `@test` obrigatórios

### Assertions
- Sempre incluir mensagem descritiva
- Usar assertions específicas (assertLessThan, assertDoesNotMatch, etc)
- Validar edge cases

---

## 🎓 Referências

- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Laravel Testing](https://laravel.com/docs/testing)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [PHP Enums](https://www.php.net/manual/en/language.enumerations.php)

---

**Última atualização:** 2025-12-17
**Cobertura total:** 5 arquivos testados (3 Enums + 2 Commands)
**Total de testes:** ~60 casos de teste
