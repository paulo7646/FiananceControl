# Plano de Otimização de Performance - FinanceControl

## Fase 1 — Configurações de Infraestrutura
- [x] Mudar cache default para `file` em `config/cache.php`
- [x] Mudar session default para `file` em `config/session.php`
- [x] Mudar queue default para `sync` em `config/queue.php`

## Fase 2 — Otimização de Queries (Eager Loading)
- [x] Adicionar `$with` no Model `Despesa` (user, categoria, mes, ano)
- [x] Adicionar `$with` no Model `Renda` (user, categoria, mes, ano)
- [x] Adicionar `$with` no Model `Mes` (ano)
- [x] Otimizar `DespesaResource` com `modifyQueryUsing`
- [x] Otimizar `RendaResource` com `modifyQueryUsing`
- [x] Otimizar `MesResource` com `modifyQueryUsing`

## Fase 3 — Otimização de Widgets
- [x] Remover polling de `FinanceStatsOverview` (2s → null)
- [x] Adicionar cache em `CategoryExpenseChart`
- [x] Adicionar cache em `CategoryIncomeChart`
- [x] Otimizar queries de `FinanceStatsOverview`

## Fase 4 — Otimização de Observers
- [x] Otimizar `MesObserver` (evitar `::all()`, usar insert direto)
- [x] Otimizar `DespesaObserver` (update direto sem carregar model)
- [x] Otimizar `RendaObserver` (update direto sem carregar model)

## Fase 5 — Índices no Banco de Dados
- [x] Criar migration de índices para foreign keys

## Fase 6 — Otimizações de Produção
- [x] Documentar comandos de cache no README

