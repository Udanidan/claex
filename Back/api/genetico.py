# -----------------------------------------------------------------------------------
# Projeto: CLAEX
# Objetivo: Realizar geração de grade de forma automatica, está sendo utilizada a base de um algotimo genetico
# Ultima atulização: 30/05/2026 Dev: Udanidan
# Devs que alteraram o codigo até o momento: Udanidan
# -----------------------------------------------------------------------------------

from random import choice, randint
import copy

# gradeSala2 = [
#     ["mat", "mat", "hist"], # segunda
#     ["mat", "mat", "quim"], # terça
#     ["port", "port", "hist"], # quarta
#     ["port","port","quim"], # quinta
#     ['-', '-', 'roblox']  # sexta
# ]

# antes do algotimo aprimorar
# gradeSala2 = [
#     ["mat", "port", "hist", "geo", "cien", "ing", "edfis", "art"],   # segunda
#     ["mat", "port", "quim", "fis", "bio", "geo", "ing", "red"],      # terça
#     ["port", "mat", "hist", "cien", "art", "edfis", "geo", "ing"],   # quarta
#     ["mat", "port", "fis", "quim", "bio", "hist", "red", "edfis"],   # quinta
#     ["port", "mat", "geo", "hist", "cien", "art", "ing", "proj"]     # sexta
# ]
gradeSala2 = [
    ['port', 'port', 'ing', 'ing', 'mat', 'mat', 'hist', 'hist'],
    ['--', 'art', 'quim', 'quim', 'art', 'fis', 'ing', 'ing'],
    ['--', '--', 'edfis', 'edfis', 'cien', 'cien', 'geo', 'geo'],
    ['port', 'port', 'fis', 'art', 'hist', 'hist', 'bio', 'bio'],
    ['--', 'proj', 'geo', 'geo', 'red', 'red', 'mat', 'mat']
]

gradeSala3 = [
    ['hist', 'hist', 'red', 'red', 'bio', 'bio', 'port', 'port'],
    ['--', 'geo', 'ing', 'ing', 'hist', 'hist', 'art', 'art'],
    ['--', 'proj', 'mat', 'mat', 'geo', 'geo', 'port', 'port'],
    ['--', 'geo', 'cien', 'cien', 'mat', 'mat', 'ing', 'ing'],
    ['--', 'art', 'edfis', 'edfis', 'fis', 'fis', 'quim', 'quim']
]

gradeSala4 = [
    ['--', '--', 'edfis', 'edfis', 'geo', 'geo', 'cien', 'cien'],
    ['bio', 'bio', 'port', 'port', 'mat', 'mat', '--', '--'],
    ['red', 'red', 'geo', 'geo', 'mat', 'mat', 'hist', 'hist'],
    ['ing', 'ing', 'art', 'proj', 'quim', 'quim', 'port', 'port'],
    ['fis', 'fis', 'art', 'art', 'ing', 'ing', 'hist', 'hist']
]

gradeSala5 = [
    ['--', '--', 'quim', 'quim', 'proj', 'cien', 'ing', 'ing'],
    ['--', 'hist', 'art', 'geo', 'edfis', 'edfis', 'mat', 'fis'],
    ['ing', 'ing', 'red', 'red', 'hist', 'hist', 'mat', 'mat'],
    ['fis', 'mat', 'geo', 'hist', 'port', 'port', 'art', 'art'],
    ['--', 'cien', 'port', 'port', 'geo', 'geo', 'bio', 'bio']
]

gradeSala6 = [
    ['--', 'ing', 'geo', 'art', 'hist', 'hist', 'geo', 'mat'],
    ['ing', 'ing', 'edfis', 'mat', 'red', 'red', 'port', 'port'],
    ['--', 'port', 'quim', 'quim', 'bio', 'bio', 'art', 'art'],
    ['--', 'edfis', 'mat', 'mat', 'geo', 'geo', 'cien', 'cien'],
    ['--', 'port', 'proj', 'ing', 'hist', 'hist', 'fis', 'fis']
]

gradeSala7 = [
    ['--', 'art', 'fis', 'fis', 'quim', 'quim', 'edfis', 'edfis'],
    ['--', 'mat', 'hist', 'hist', 'proj', 'geo', '--', 'geo'],
    ['--', 'mat', 'ing', 'ing', 'port', 'port', 'bio', 'bio'],
    ['art', 'art', 'red', 'red', 'ing', 'ing', 'hist', 'hist'],
    ['geo', 'geo', 'cien', 'cien', 'mat', 'mat', 'port', 'port']
]

materias = [
    "--", # "mat",
    "mat",
    "mat",
    "mat",
    "mat",
    "--", # "port",
    "port",
    "port",
    "port",
    "port",
    "hist",
    "hist",
    "hist",
    "hist",
    "geo",
    "geo",
    "geo",
    "geo",
    "--", # "cien",
    "cien",
    "cien",
    "fis",
    "fis",
    "quim",
    "quim",
    "bio",
    "bio",
    "ing",
    "ing",
    "ing",
    "ing",
    "--", # "edfis",
    "edfis",
    "edfis",
    "art",
    "art",
    "art",
    "red",
    "red",
    "proj"
]

# --------------- ALGORITIMO DE GERAÇÃO DE GRADE ---------------
def gerarGrade(materia: list, quantAulas: int):
    materias = materia.copy()
    grade = [["-" for a in range(quantAulas)] for i in range(5)]

    for dia in range(len(grade)):
        for mat in range(len(grade[dia])):
            if materias == []:
                grade[dia][mat] = "--"
            else:
                materiaAleatoria = choice(materias)
                grade[dia][mat] = materiaAleatoria
                materias.remove(materiaAleatoria)
    return grade

def mostrarGrade(grade: list):
    dias = ["segunda", "terça", "quarta", "quinta", "sexta"]
    for e in range(5):
        print(dias[e]+":",grade[e])

# --------------- ANALISE DA QUALIDADE DA GRADE ---------------

def validarGrade(grade: list, gradesExistentes: list, materias: list):
    pontos = 0
    
    pontos += mesmoDia(grade, materias)
    pontos += aulasSeguidas(grade)
    pontos += validarVagas(grade)
    pontos += limitAulasDiaria(grade, materias)
    pontos += profIguais(grade, gradesExistentes) * -10
    
    return pontos

def profIguais(gradeAnalisada: list, gradesExisentes: list):
    iguais = 0 #Ruim
    for grade in gradesExisentes:
        for i in range(len(gradeAnalisada)):
            for a in range(len(gradeAnalisada[i])):
                if gradeAnalisada[i][a] == grade[i][a] and gradeAnalisada[i][a] != "--":
                    iguais += 1
    
    return iguais

def mesmoDia(grade: list, materia: list):
    matSimp = set(materia)
    total = 0
    for e in matSimp:
        for i in grade:
            if i.count(e) > 1:
                total += 0
    return total

def aulasSeguidas(grade: list):
    total = 0
    for i in grade:
        for a in range(len(i)):
            if a != len(i)-1 and i[a] == i[a+1] and a % 2 == 0: # verifica se não tem intervalo no meio
                total += 3
    return total

def validarVagas(grade: list):
    total = 0
    for i in grade:
        for a in range(len(i)):
            if a == 0 and i[a] == '--' or a == len(i)-1 and i[a] == '--':
                total += 3
    return total

def limitAulasDiaria(grade: list, materias:list):
    total = 0
    mats = materias.copy()
    mats.append("--") # garante que aulas vagas não ocorram em excessão no dia, pode ser removido
    for i in set(mats):
        for a in grade:
            if a.count(i) > 2:
                total -= (a.count(i)-2)*2
    return total

# --------------- TREINAMENTO E ALTERAÇÃO DA GRADE ---------------

def removerConflitos(grade):
    cont = 0
    gradem = mutargrade(grade)
    mats = profIguais(gradem)
    # print("iguais:", mats[0])
    # print("diferentes uhuu:", mats[1])
    while mats[0] != 0:
        cont += 1
        gradem = mutargrade(gradem)
        mats = profIguais(gradem)

    return [gradem, cont]

def mutargrade(grade: list):
    rand1 = randint(0, len(grade)-1)
    rand2 = randint(0, quantAulasDia-1)
    
    rand3 = randint(0, len(grade)-1)
    rand4 = randint(0, quantAulasDia-1)
    
    apoio = grade[rand1][rand2]
    grade[rand1][rand2] = grade[rand3][rand4]
    grade[rand3][rand4] = apoio
    
    return grade

def avacarGeracao(grade: list, gradesExistentes: list, materia: list, quantGeracoes: int, quantIndividuos: int):
    listaInd = ['' for i in range(quantIndividuos)]
    melhorInd = copy.deepcopy(grade)
    melhorScore = validarGrade(melhorInd, gradesExistentes, materia)

    for geracao in range(quantGeracoes):
        for ind in range(quantIndividuos):
            listaInd[ind] = mutargrade(copy.deepcopy(melhorInd))
        for indv in listaInd:
            indvScore = validarGrade(indv, gradesExistentes, materia)
            # print("pontuação melhor:", melhorScore, "| pontuação verificada:", indvScore, validarGrade(melhorInd, materia) < validarGrade(indv, materia))
            if melhorScore < indvScore:
                melhorInd = copy.deepcopy(indv)
                melhorScore = indvScore
    
    return melhorInd

# -------------------- TESTES --------------------

quantAulasDia = 8
tamanhoPopulacao = 40
quantGeracoes = 40
pontuacao = 0

# gradesExistentes = [gradeSala2, gradeSala3, gradeSala4, gradeSala5, gradeSala6]
gradesExistentes = [gradeSala2]

grade1 = gerarGrade(materias, quantAulasDia)

gradeMutada = avacarGeracao(grade1, gradesExistentes, materias, quantGeracoes, tamanhoPopulacao)

mostrarGrade(grade1)
print("-------------------")
mostrarGrade(gradeMutada)

print("pontuação da grade inicial:", validarGrade(grade1, gradesExistentes, materias))
mats = profIguais(grade1, gradesExistentes)
print("iguais:", mats)

print("pontuação da grade mutada:", validarGrade(gradeMutada, gradesExistentes, materias))
mats = profIguais(gradeMutada, gradesExistentes)
print("iguais:", mats)