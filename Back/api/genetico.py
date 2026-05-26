from random import choice, randint
import copy

# gradeSala2 = [
#     ["mat", "mat", "hist"], # segunda
#     ["mat", "mat", "quim"], # terça
#     ["port", "port", "hist"], # quarta
#     ["port","port","quim"], # quinta
#     ['-', '-', 'roblox']  # sexta
# ]

gradeSala2 = [
    ["mat", "port", "hist", "geo", "cien", "ing", "edfis", "art"],   # segunda
    ["mat", "port", "quim", "fis", "bio", "geo", "ing", "red"],      # terça
    ["port", "mat", "hist", "cien", "art", "edfis", "geo", "ing"],   # quarta
    ["mat", "port", "fis", "quim", "bio", "hist", "red", "edfis"],   # quinta
    ["port", "mat", "geo", "hist", "cien", "art", "ing", "proj"]     # sexta
]
materias = [
    "mat",
    "mat",
    "mat",
    "mat",
    "mat",
    "port",
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
    "cien",
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
    "edfis",
    "edfis",
    "edfis",
    "art",
    "art",
    "art",
    "red",
    "red",
    "proj"
]

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

# inicio da analise da qualidade da grade

def validarGrade(grade: list, materias: list):
    pontos = 0
    
    pontos += mesmoDia(grade, materias)
    pontos += aulasSeguidas(grade)
    
    return pontos

def profIguais(grade: list):
    iguais = 0 #Ruim
    for i in range(len(grade)):
        for a in range(len(grade[i])):
            if grade[i][a] == gradeSala2[i][a]:
                # print("posição",i,a,":", grade[i][a], "==", gradeSala2[i][a])
                iguais += 1
    
    return iguais

def mesmoDia(grade: list, materia: list):
    matSimp = set(materia)
    total = 0
    for e in matSimp:
        for i in grade:
            if i.count(e) > 1:
                total += 1
    return total

def aulasSeguidas(grade: list):
    total = 0
    for i in grade:
        for a in range(len(i)):
            if a != len(i)-1:
                if i[a] == i[a+1]:
                    total += 1
    return total

# treinamentos e alteração da grade

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
        # print("iguais:", mats[0])
        # print("diferentes uhuu:", mats[1])
    
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

def avacarGeracao(grade: list, materia: list, quantGeracoes: int, quantIndividuos: int):
    listaInd = ['' for i in range(quantIndividuos)]
    melhorInd = copy.deepcopy(grade)
    melhorScore = validarGrade(melhorInd, materia)
    for i in range(profIguais(melhorInd)):
        melhorScore -= 10

    for geracao in range(quantGeracoes):
        for ind in range(quantIndividuos):
            listaInd[ind] = mutargrade(copy.deepcopy(melhorInd))
        for indv in listaInd:
            indvScore = validarGrade(indv, materia)
            for i in range(profIguais(indv)):
                indvScore -= 10
            # print("pontuação melhor:", melhorScore, "| pontuação verificada:", indvScore, validarGrade(melhorInd, materia) < validarGrade(indv, materia))
            if melhorScore < indvScore:
                melhorInd = copy.deepcopy(indv)
                melhorScore = indvScore
    
    return melhorInd

# testes
quantAulasDia = 8
tamanhoPopulacao = 20
quantGeracoes = 20
pontuacao = 0

grade1 = gerarGrade(materias, quantAulasDia)

gradeMutada = avacarGeracao(grade1, materias, quantGeracoes, tamanhoPopulacao)

mostrarGrade(grade1)
print("-------------------")
mostrarGrade(gradeMutada)

print("grade 2:", validarGrade(gradeSala2, materias))
print("pontuação da grade inicial:", validarGrade(grade1,materias))
mats = profIguais(grade1)
print("iguais:", mats)

print("pontuação da grade mutada:", validarGrade(gradeMutada,materias))
mats = profIguais(gradeMutada)
print("iguais:", mats)