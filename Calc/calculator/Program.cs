using System;

namespace SimpleCalculator
{
    class Program
    {
        static void Main()
        {
            // Display a welcome message
            Console.WriteLine("Welcome to Simple Calculator!");
            bool continueCalculation = true;

            while (continueCalculation)
            {
                // Get two valid numbers from the user
                double num1 = InputValidation.GetValidNumber("Enter the first number: ");
                double num2 = InputValidation.GetValidNumber("Enter the second number: ");

                // Display operation choices
                Console.WriteLine("Select an operation:");
                Console.WriteLine("1. Addition (+)");
                Console.WriteLine("2. Subtraction (-)");
                Console.WriteLine("3. Multiplication (*)");
                Console.WriteLine("4. Division (/)");
                Console.Write("Enter your choice (1-4): ");

                // Read user choice
                string choice = Console.ReadLine();
                double result = 0;
                bool validOperation = true;

                // Perform the selected arithmetic operation
                switch (choice)
                {
                    case "1":
                        result = Calculator.Add(num1, num2);
                        break;
                    case "2":
                        result = Calculator.Subtract(num1, num2);
                        break;
                    case "3":
                        result = Calculator.Multiply(num1, num2);
                        break;
                    case "4":
                        try
                        {
                            result = Calculator.Divide(num1, num2);
                        }
                        catch (DivideByZeroException ex)
                        {
                            Console.WriteLine(ex.Message);
                            validOperation = false;
                        }
                        break;
                    default:
                        Console.WriteLine("Invalid selection. Please choose a valid operation.");
                        validOperation = false;
                        break;
                }

                // Display result if operation was valid
                if (validOperation)
                {
                    Console.WriteLine($"Result: {result}");
                }

                // Ask user if they want to perform another calculation
                Console.Write("Do you want to perform another calculation? (y/n): ");
                continueCalculation = Console.ReadLine().Trim().ToLower() == "y";
            }

            // Goodbye message
            Console.WriteLine("Thank you for using Simple Calculator!");
        }
    }
}
